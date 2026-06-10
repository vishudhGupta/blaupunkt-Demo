<?php

namespace App\Support;

class LocaleRegistry
{
    public static function supportedLocales(): array
    {
        return config('markets.supported_locales', []);
    }

    public static function isSupported(string $locale): bool
    {
        return in_array($locale, self::supportedLocales(), true);
    }

    public static function countryToLocale(?string $countryCode): ?string
    {
        if (! $countryCode) {
            return null;
        }

        return config('markets.country_to_locale.' . strtoupper($countryCode));
    }

    public static function fallbackLocale(): string
    {
        return config('markets.default_locale', 'eu-en');
    }

    public static function switchLanguage(string $currentLocale, string $targetLanguage): ?string
    {
        $parts = explode('-', $currentLocale);

        if (count($parts) !== 2) {
            return null;
        }

        [$country] = $parts;
        $candidate = $country . '-' . strtolower($targetLanguage);

        return self::isSupported($candidate) ? $candidate : null;
    }

    public static function marketDefaultLocale(string $countryCode): ?string
    {
        return config('markets.markets.' . strtolower($countryCode) . '.default');
    }
}
