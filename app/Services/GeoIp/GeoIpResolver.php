<?php

namespace App\Services\GeoIp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GeoIpResolver
{
    public function resolveCountry(Request $request): ?string
    {
        // 1. Cloudflare header (fastest — works if Cloudflare proxy is enabled)
        $cloudflareCountry = $request->header('CF-IPCountry');
        if ($this->isValidCountry($cloudflareCountry)) {
            return strtoupper($cloudflareCountry);
        }

        $ip = $request->ip();

        // 2. MaxMind local database (if file is present)
        $maxMindCountry = $this->resolveWithMaxMind($ip);
        if ($this->isValidCountry($maxMindCountry)) {
            return strtoupper($maxMindCountry);
        }

        // 3. Free API fallback — cached per IP for 24 hours to avoid latency on repeat visits
        return $this->resolveWithApi($ip);
    }

    private function resolveWithMaxMind(?string $ip): ?string
    {
        if (! $ip) {
            return null;
        }

        $databasePath = storage_path('app/geoip/GeoLite2-Country.mmdb');

        if (! is_file($databasePath) || ! class_exists('GeoIp2\\Database\\Reader')) {
            return null;
        }

        try {
            $reader = new \GeoIp2\Database\Reader($databasePath);
            $record = $reader->country($ip);

            return $record->country->isoCode;
        } catch (\Throwable) {
            return null;
        }
    }

    private function resolveWithApi(?string $ip): ?string
    {
        if (! $ip || $ip === '127.0.0.1' || $ip === '::1') {
            return null;
        }

        $cacheKey = 'geoip_' . md5($ip);

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($ip) {
            try {
                $ctx = stream_context_create([
                    'http' => [
                        'timeout'         => 3,
                        'ignore_errors'   => true,
                        'method'          => 'GET',
                        'user_agent'      => 'BlaupunktApp/1.0',
                    ],
                ]);

                $url  = 'http://ip-api.com/json/' . rawurlencode($ip) . '?fields=countryCode&lang=en';
                $body = @file_get_contents($url, false, $ctx);

                if (! $body) {
                    return null;
                }

                $data = json_decode($body, true);
                $code = $data['countryCode'] ?? null;

                return $this->isValidCountry($code) ? strtoupper($code) : null;
            } catch (\Throwable) {
                return null;
            }
        });
    }

    private function isValidCountry(?string $country): bool
    {
        return is_string($country) && preg_match('/^[A-Za-z]{2}$/', $country) === 1;
    }
}
