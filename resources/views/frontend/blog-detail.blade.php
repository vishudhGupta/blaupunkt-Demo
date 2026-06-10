@extends('frontend.layout')

@section('content')
    <h1>{{ $blog->title }}</h1>
    <article>{!! nl2br(e($blog->content)) !!}</article>
@endsection
