@extends('frontend.layout')

@section('content')
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem; border-radius: 8px; margin-bottom: 3rem; text-align: center;">
        <h1 style="color: white; margin-bottom: 1rem; font-size: 2.5rem;">{{ $pageContent['title'] ?? 'Welcome to Blaupunkt' }}</h1>
        <p style="font-size: 1.1rem;">{{ $pageContent['subtitle'] ?? 'Multi-country and multi-language storefront' }}</p>
        <p style="font-size: 0.9rem; margin-top: 1rem; opacity: 0.9;">You are viewing content for: <strong>{{ $locale }}</strong></p>
    </div>

    <section style="background: #f5f7fb; padding: 2rem; border-radius: 8px; margin-bottom: 3rem; border: 1px solid #e5e7eb;">
        <h2 style="margin-bottom: 1rem;">{{ $pageContent['title'] ?? 'Country Overview' }}</h2>

        @foreach(($pageContent['paragraphs'] ?? []) as $paragraph)
            <p style="margin-bottom: 1rem; color: #444; line-height: 1.8;">{{ $paragraph }}</p>
        @endforeach

        @if(! empty($pageContent['highlights'] ?? []))
            <ul style="margin-left: 1.5rem; line-height: 1.8; color: #444;">
                @foreach($pageContent['highlights'] as $highlight)
                    <li>{{ $highlight }}</li>
                @endforeach
            </ul>
        @endif
    </section>

    <section style="margin-bottom: 3rem;">
        <h2 style="margin-bottom: 1.5rem;">Featured Products</h2>
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div style="background: #f5f5f5; height: 150px; border-radius: 4px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center;">
                            <span style="color: #999; font-size: 0.9rem;">{{ $product->product->sku }}</span>
                        </div>
                        <h3>{{ $product->name }}</h3>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                            <strong>SKU:</strong> {{ $product->product->sku }}
                        </p>
                        @if($product->product->variants()->count() > 0)
                            <p style="font-size: 0.85rem; color: #999;">
                                {{ $product->product->variants()->count() }} variant(s) available
                            </p>
                        @endif
                        <p style="color: #666; margin: 0.5rem 0; font-size: 0.9rem;">
                            {{ Str::limit($product->short_description ?? $product->description, 80) }}
                        </p>
                        <a href="/{{ $locale }}/products/{{ $product->slug }}" style="color: #0066cc; text-decoration: none; font-weight: 500;">View Product →</a>
                    </div>
                @endforeach
            </div>
        @else
            <div style="background: #fff3cd; padding: 1.5rem; border-radius: 4px; border-left: 4px solid #ffc107;">
                <strong>No products available</strong> for your region yet. Check back soon!
            </div>
        @endif
    </section>

    <section style="background: #f5f5f5; padding: 2rem; border-radius: 8px;">
        <h2 style="margin-bottom: 1rem;">About This Store</h2>
        <p>This is a demonstration of a multi-country, multi-language e-commerce platform built with Laravel.</p>
        <ul style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
            <li>Browse products available in your region</li>
            <li>Switch between languages and countries</li>
            <li>View product variants and availability</li>
            <li>All content is localized for your region</li>
        </ul>
    </section>
@endsection
