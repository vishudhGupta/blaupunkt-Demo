@extends('frontend.layout')

@section('content')
    <h1>Search Results</h1>
    <p>Query: {{ $query }}</p>

    <h2>Products</h2>
    <ul>
        @forelse($products as $product)
            <li>{{ $product->name }}</li>
        @empty
            <li>No product matches.</li>
        @endforelse
    </ul>

    <h2>Blogs</h2>
    <ul>
        @forelse($blogs as $blog)
            <li>{{ $blog->title }}</li>
        @empty
            <li>No blog matches.</li>
        @endforelse
    </ul>
@endsection
