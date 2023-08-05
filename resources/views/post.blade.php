@extends('layouts.main')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>Posted by {{ $post->domain }} on {{ $post->created_at }}.</p>
    <p>Upvoted by {{ $post->votes_count }} users.</p>
    <section id="content">
        <p>{{ $post->content }}</p>
    </section>
    <h2>Comments</h2>
    <ul>
        @foreach ($comments as $comment)
            <li>
                <p>{{ $comment->content }}</p>
                <p>Posted by {{ $comment->user->name }} on {{ $comment->created_at }}.</p>
            </li>
        @endforeach
    </ul>
    <section>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="/comment">
            @csrf <!-- {{ csrf_field() }} -->
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <label for="content">Comment</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
            <input type="submit" value="Create Comment">
        </form>
    </section>
@endsection