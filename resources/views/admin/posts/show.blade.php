@extends('admin.layouts.base')

@section('mainContent')
    <h1>{{ $post->title }}</h1>
    <h2>Written by: {{ $post->user->name }}</h2>
    <img src="{{ $post->image }}" alt="{{ $post->title }}">
    <h3>In Category: {{ $post->category->name }}</h3>
        @foreach ($post->tags as $tag)
            <span class="tag">{{ $tag->name }}</span>
        @endforeach
    <p>{{ $post->content }}</p>
@endsection
