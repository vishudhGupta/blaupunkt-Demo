@extends('frontend.layout')

@section('content')
    <h1>Products</h1>
    
    @if(isset($categories) && $categories->count() > 0)
        <div class="category-nav">
            <a href="/{{ $locale }}/products" @if(!isset($category) || !$category) class="active" @endif>All Products</a>
            @foreach($categories as $cat)
                <a href="/{{ $locale }}/products?category={{ $cat }}" @if(isset($category) && $category === $cat) class="active" @endif>{{ ucfirst($cat) }}</a>
            @endforeach
        </div>
    @endif

    @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <h3>{{ $product->name }}</h3>
                    <p><strong>SKU:</strong> {{ $product->product->sku }}</p>
                    <p>{{ Str::limit($product->short_description ?? $product->description, 100) }}</p>
                    <a href="/{{ $locale }}/products/{{ $product->slug }}">View Details →</a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div style="text-align: center; margin: 2rem 0;">
                {{ $products->links() }}
            </div>
        @endif
    @else
        <p>No products available in your region.</p>
    @endif
@endsection
