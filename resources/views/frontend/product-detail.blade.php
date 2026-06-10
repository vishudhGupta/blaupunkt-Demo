@extends('frontend.layout')

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;">
        <div>
            <div style="background: #f5f5f5; height: 300px; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-bottom: 1rem;">
                <span style="color: #999;">Product Image</span>
            </div>
        </div>
        <div>
            <h1>{{ $product->name }}</h1>
            <p style="font-size: 1.1rem; color: #666; margin-bottom: 1rem;">
                <strong>SKU:</strong> {{ $product->product->sku }}
            </p>
            
            @if($product->short_description)
                <p style="font-size: 1rem; margin-bottom: 1.5rem;">{{ $product->short_description }}</p>
            @endif

            @if($variants && $variants->count() > 0)
                <div class="variants" style="background: #f9f9f9; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 1rem;">Select Variant:</h3>
                    <form style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($variants as $variant)
                            <label style="display: flex; align-items: center; cursor: pointer; padding: 0.5rem;">
                                <input type="radio" name="variant" value="{{ $variant->sku }}" @if($loop->first) checked @endif style="margin-right: 0.5rem; cursor: pointer;" />
                                <span>{{ $variant->name }}</span>
                                @if($variant->description)
                                    <span style="color: #999; font-size: 0.9rem; margin-left: 0.5rem;">({{ $variant->description }})</span>
                                @endif
                            </label>
                        @endforeach
                    </form>
                </div>
            @endif

            <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
                <button style="padding: 0.75rem 2rem; background: #0066cc; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem;">Add to Cart</button>
                <button style="padding: 0.75rem 2rem; background: #f0f0f0; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; font-size: 1rem;">Add to Wishlist</button>
            </div>
        </div>
    </div>

    <hr style="margin: 3rem 0; border: none; border-top: 1px solid #ddd;">

    <div>
        <h2>Description</h2>
        <article style="line-height: 1.8; color: #555;">
            {!! nl2br(e($product->description ?? '')) !!}
        </article>
    </div>

    @if($product->seo_description)
        <div style="margin-top: 2rem; padding: 1rem; background: #f0f7ff; border-radius: 4px; font-size: 0.9rem; color: #666;">
            <strong>About this product:</strong> {{ $product->seo_description }}
        </div>
    @endif

    <div style="margin-top: 2rem;">
        <a href="/{{ $locale }}/products" style="color: #0066cc; text-decoration: none;">← Back to Products</a>
    </div>
@endsection
