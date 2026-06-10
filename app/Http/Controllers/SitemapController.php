<?php

namespace App\Http\Controllers;

use App\Models\BlogTranslation;
use App\Models\ProductTranslation;
use App\Support\LocaleRegistry;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $entries = collect(LocaleRegistry::supportedLocales())
            ->map(fn (string $locale) => '<sitemap><loc>' . url('/sitemap-' . $locale . '.xml') . '</loc></sitemap>')
            ->implode('');

        return response('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . $entries . '</sitemapindex>', 200)
            ->header('Content-Type', 'application/xml');
    }

    public function locale(string $locale): Response
    {
        abort_unless(LocaleRegistry::isSupported($locale), 404);

        $pages = [
            url('/' . $locale),
            url('/' . $locale . '/products'),
            url('/' . $locale . '/blogs'),
        ];

        $productUrls = ProductTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->pluck('slug')
            ->map(fn (string $slug) => url('/' . $locale . '/products/' . $slug));

        $blogUrls = BlogTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->pluck('slug')
            ->map(fn (string $slug) => url('/' . $locale . '/blogs/' . $slug));

        $entries = collect($pages)
            ->merge($productUrls)
            ->merge($blogUrls)
            ->map(fn (string $url) => '<url><loc>' . e($url) . '</loc></url>')
            ->implode('');

        return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . $entries . '</urlset>', 200)
            ->header('Content-Type', 'application/xml');
    }
}
