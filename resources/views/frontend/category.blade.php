@extends('frontend.layout')

@section('content')
    <h1>Category: {{ $slug }}</h1>
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>

    {{ $products->links() }}
@endsection
