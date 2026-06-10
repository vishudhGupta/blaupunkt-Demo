<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    public function run(): void
    {
        $defaultByCountry = collect(config('markets.markets', []))
            ->mapWithKeys(fn (array $market, string $countryCode) => [strtolower($countryCode) => $market['default'] ?? null]);

        foreach (config('markets.supported_locales', []) as $code) {
            [$country, $language] = explode('-', $code);

            Locale::query()->updateOrCreate(
                ['code' => $code],
                [
                    'country_code' => $country,
                    'language_code' => $language,
                    'is_default_for_country' => $defaultByCountry->get($country) === $code,
                    'is_active' => true,
                ]
            );
        }
    }
}
