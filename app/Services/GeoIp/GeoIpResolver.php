<?php

namespace App\Services\GeoIp;

use Illuminate\Http\Request;

class GeoIpResolver
{
    public function resolveCountry(Request $request): ?string
    {
        $cloudflareCountry = $request->header('CF-IPCountry');

        if ($this->isValidCountry($cloudflareCountry)) {
            return strtoupper($cloudflareCountry);
        }

        $maxMindCountry = $this->resolveWithMaxMind($request->ip());

        return $this->isValidCountry($maxMindCountry) ? strtoupper($maxMindCountry) : null;
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

    private function isValidCountry(?string $country): bool
    {
        return is_string($country) && preg_match('/^[A-Za-z]{2}$/', $country) === 1;
    }
}
