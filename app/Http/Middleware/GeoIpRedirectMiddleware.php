<?php

namespace App\Http\Middleware;

use App\Services\GeoIp\GeoIpResolver;
use App\Support\LocaleRegistry;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeoIpRedirectMiddleware
{
    public function __construct(private GeoIpResolver $resolver)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->is('/')) {
            return $next($request);
        }

        if ($request->query('skip_geo') === '1') {
            return $next($request);
        }

        $country = $this->resolver->resolveCountry($request);
        $locale = LocaleRegistry::countryToLocale($country) ?? LocaleRegistry::fallbackLocale();

        if (! LocaleRegistry::isSupported($locale)) {
            $locale = 'eu-en';
        }

        return redirect()->to('/' . $locale, 302, [
            'Vary' => 'CF-IPCountry',
        ]);
    }
}
