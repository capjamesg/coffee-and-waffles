@extends('layouts.main')

@section('content')
<form method="POST" action="/post">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
    <label for="syndicated_post_url">Syndicated Post URL</label>
    <input type="text" name="syndicated_post_url" id="syndicated_post_url">
    <label for="content">Content</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <input type="submit" value="Create Post">
</form>
@endsection