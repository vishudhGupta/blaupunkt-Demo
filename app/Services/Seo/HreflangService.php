<?php

namespace App\Services\Seo;

use App\Support\LocaleRegistry;
use Illuminate\Support\Collection;

class HreflangService
{
    public function forPath(string $path): Collection
    {
        $path = '/' . ltrim($path, '/');

        return collect(LocaleRegistry::supportedLocales())
            ->mapWithKeys(function (string $locale) use ($path) {
                return [$locale => url('/' . $locale . $path)];
            });
    }
}
