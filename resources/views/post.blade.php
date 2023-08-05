@extends('layouts.main')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>Posted by {{ $post->domain }} on {{ $post->created_at }}.</p>
    <p>{{ $post->content }}</p>
@endsection