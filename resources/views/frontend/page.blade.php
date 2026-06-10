@extends('frontend.layout')

@section('content')
    <h1>{{ $page->title }}</h1>
    <article>{!! nl2br(e($page->content ?? '')) !!}</article>
@endsection
