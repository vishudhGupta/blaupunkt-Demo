<!DOCTYPE html>
<html lang="{{ str_replace('-', '_', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Blaupunkt Markets' }}</title>
    @if(isset($hreflang))
        @foreach($hreflang as $code => $href)
            <link rel="alternate" hreflang="{{ $code }}" href="{{ $href }}" />
        @endforeach
    @endif
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; line-height: 1.5; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        header { background: #f5f5f5; padding: 1rem 0; margin-bottom: 2rem; border-bottom: 1px solid #ddd; }
        nav { display: flex; gap: 2rem; margin-bottom: 1rem; }
        nav a { color: #0066cc; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .locale-info { font-size: 0.9rem; color: #666; margin-bottom: 1rem; }
        .switches { display: flex; gap: 2rem; font-size: 0.9rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .switch-group { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .switch-group a { color: #0066cc; text-decoration: none; margin-right: 0.3rem; }
        .switch-group a:hover { text-decoration: underline; }
        .switch-group strong { margin-right: 0.5rem; }
        .category-nav { display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .category-nav a, .category-nav button { padding: 0.5rem 1rem; background: #f0f0f0; border: 1px solid #ddd; cursor: pointer; text-decoration: none; color: #333; border-radius: 4px; }
        .category-nav a:hover, .category-nav button:hover { background: #e0e0e0; }
        .category-nav a.active { background: #0066cc; color: white; }
        .search-box { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-box input { flex: 1; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; }
        .search-box button { padding: 0.5rem 1rem; background: #0066cc; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .product-card { border: 1px solid #ddd; border-radius: 8px; padding: 1rem; background: white; }
        .product-card h3 { margin-bottom: 0.5rem; }
        .product-card p { font-size: 0.9rem; color: #666; margin-bottom: 0.5rem; }
        .product-card a { color: #0066cc; text-decoration: none; }
        .product-card a:hover { text-decoration: underline; }
        .variants { margin-top: 1rem; }
        .variants label { display: block; margin: 0.3rem 0; }
        .variants input[type="radio"] { margin-right: 0.5rem; }
        h1 { margin-bottom: 1rem; }
        h2 { margin: 2rem 0 1rem; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="locale-info"><strong>Locale:</strong> {{ $locale ?? 'global' }}</div>
            <nav>
                <a href="/{{ $locale }}/">🏠 Home</a>
                <a href="/{{ $locale }}/products">📦 Products</a>
                <a href="/{{ $locale }}/blogs">📰 Blogs</a>
                <a href="/{{ $locale }}/about-us">ℹ️ About</a>
            </nav>

            <div class="search-box">
                <form method="GET" action="/{{ $locale }}/search" style="display: flex; width: 100%; gap: 0.5rem;">
                    <input type="text" name="q" placeholder="Search this locale" value="{{ request('q') }}" />
                    <button type="submit">Search</button>
                </form>
            </div>

            <div class="switches">
                <div class="switch-group">
                    <strong>Language:</strong>
                    @foreach(config('markets.supported_locales', []) as $switchLocale)
                        @if(str_starts_with($switchLocale, explode('-', $locale)[0] . '-'))
                            <a href="{{ route('switch-locale', ['locale' => $switchLocale, 'path' => request()->path()]) }}" @if($switchLocale === $locale) class="active" @endif>{{ $switchLocale }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="switch-group">
                    <strong>Country:</strong>
                    @foreach(config('markets.markets', []) as $countryCode => $market)
                        <a href="/{{ $market['default'] }}/">{{ strtoupper($countryCode) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
