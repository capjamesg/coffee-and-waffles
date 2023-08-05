@extends('layouts.main')

@section('title', 'Trending posts')
@section('description', 'Trending posts on Waffles and Coffee')

@section('content')
    @if ($postsByUser)
        <h1>Posts by {{ $user->name }}</h1>
    @else
        <h1>Posts</h1>
    @endif
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ $post->syndicated_post_url }}">
                    <div class="title">#{{ $post->id }}: {{ $post->title }}</div>
                    <div class="meta">{{ $post->domain }}</div>
                    <p><a href="/upvote/{{ $post->id }}">({{ $post->votes_count }}) Upvote</a> | ({{ $post->comments_count }}) <a href="/post/{{ $post->slug }}">Comments</a></p>
                </a>
            </li>
        @endforeach
    </ul>
@endsection