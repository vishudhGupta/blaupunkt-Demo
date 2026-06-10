@extends('frontend.layout')

@section('content')
    <h1>Blogs</h1>
    <ul>
        @foreach($blogs as $blog)
            <li><a href="/{{ $locale }}/blogs/{{ $blog->slug }}">{{ $blog->title }}</a></li>
        @endforeach
    </ul>

    {{ $blogs->links() }}
@endsection
