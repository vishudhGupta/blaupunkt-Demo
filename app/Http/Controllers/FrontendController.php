<?php

namespace App\Http\Controllers;

use App\Models\BlogTranslation;
use App\Models\Locale;
use App\Models\PageTranslation;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Services\Seo\HreflangService;
use App\Support\LocaleRegistry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(string $locale, HreflangService $hreflangService): View
    {
        $currentLocale = Locale::where('code', $locale)->firstOrFail();
        $defaultCountryPage = config('country_pages.default', 'eu-en');
        $pageContent = config('country_pages.' . $locale, config('country_pages.' . $defaultCountryPage, []));
        
        // Get products available in this market
        $products = ProductTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->whereHas('product', fn ($query) => $query->whereHas('markets', fn ($m) => $m->where('locale_id', $currentLocale->id)))
            ->latest('id')
            ->limit(8)
            ->get();

        return view('frontend.home', [
            'locale' => $locale,
            'products' => $products,
            'pageContent' => $pageContent,
            'hreflang' => $hreflangService->forPath('/'),
        ]);
    }

    public function page(string $locale, string $slug, HreflangService $hreflangService): View
    {
        $page = PageTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.page', [
            'locale' => $locale,
            'page' => $page,
            'hreflang' => $hreflangService->forPath('/' . $slug),
        ]);
    }

    public function products(string $locale): View
    {
        $currentLocale = Locale::where('code', $locale)->firstOrFail();
        $category = request('category');
        
        // Get available product categories by extracting from SKUs
        $allProducts = Product::whereHas('markets', fn ($q) => $q->where('locale_id', $currentLocale->id))->get();
        $categories = $allProducts->map(fn ($p) => explode('-', $p->sku)[0])->unique()->sort()->values();
        
        // Filter by category if provided
        $query = ProductTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->whereHas('product', function ($query) use ($currentLocale, $category) {
                $query->whereHas('markets', fn ($m) => $m->where('locale_id', $currentLocale->id));
                if ($category) {
                    $query->where('sku', 'like', $category . '%');
                }
            });

        $products = $query->paginate(20);

        return view('frontend.products', compact('locale', 'products', 'categories', 'category'));
    }

    public function productDetail(string $locale, string $slug): View
    {
        $currentLocale = Locale::where('code', $locale)->firstOrFail();
        
        $product = ProductTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->where('slug', $slug)
            ->firstOrFail();

        // Get variants for this product in this locale
        $variants = $product->product->variants()->get();

        return view('frontend.product-detail', [
            'locale' => $locale,
            'product' => $product,
            'variants' => $variants,
        ]);
    }

    public function blogs(string $locale): View
    {
        $blogs = BlogTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->latest('id')
            ->paginate(20);

        return view('frontend.blogs', compact('locale', 'blogs'));
    }

    public function blogDetail(string $locale, string $slug): View
    {
        $blog = BlogTranslation::query()
            ->whereHas('locale', fn ($query) => $query->where('code', $locale))
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.blog-detail', compact('locale', 'blog'));
    }

    public function category(string $locale, string $slug): View
    {
        return $this->products($locale, $slug);
    }

    public function search(Request $request, string $locale): View
    {
        $query = trim((string) $request->query('q', ''));
        $currentLocale = Locale::where('code', $locale)->firstOrFail();

        $products = ProductTranslation::query()
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('name', 'like', '%' . $query . '%')
                        ->orWhere('description', 'like', '%' . $query . '%');
                });
            })
            ->whereHas('locale', fn ($builder) => $builder->where('code', $locale))
            ->whereHas('product', fn ($builder) => $builder->whereHas('markets', fn ($m) => $m->where('locale_id', $currentLocale->id)))
            ->limit(20)
            ->get();

        $blogs = BlogTranslation::query()
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('title', 'like', '%' . $query . '%')
                        ->orWhere('content', 'like', '%' . $query . '%');
                });
            })
            ->whereHas('locale', fn ($builder) => $builder->where('code', $locale))
            ->limit(20)
            ->get();

        return view('frontend.search', [
            'locale' => $locale,
            'query' => $query,
            'products' => $products,
            'blogs' => $blogs,
        ]);
    }

    public function switchLocale(Request $request)
    {
        $targetLocale = (string) $request->query('locale');

        abort_unless(LocaleRegistry::isSupported($targetLocale), 404);

        $path = ltrim((string) $request->query('path', '/'), '/');
        $segments = explode('/', $path);

        if (count($segments) > 0 && $segments[0] !== '') {
            $segments[0] = $targetLocale;
        } else {
            $segments = [$targetLocale];
        }

        return redirect('/' . implode('/', $segments));
    }
}
