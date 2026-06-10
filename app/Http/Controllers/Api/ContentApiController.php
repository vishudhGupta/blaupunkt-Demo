<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogTranslation;
use App\Models\PageTranslation;
use App\Models\ProductTranslation;

class ContentApiController extends Controller
{
    public function products(string $locale)
    {
        return ProductTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->paginate(25);
    }

    public function blogs(string $locale)
    {
        return BlogTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->paginate(25);
    }

    public function page(string $locale, string $slug)
    {
        return PageTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
