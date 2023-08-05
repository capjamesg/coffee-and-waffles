@extends('layouts.main')
@section('title', 'Login')
@section('description', 'Login to Waffles and Coffee')

@section('content')
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color: red;">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <form method="POST" action="/login">
        @csrf <!-- {{ csrf_field() }} -->
        <label for="name">Username:</label>
        <input type="text" name="name" id="name">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login">
    </form>
    <p><a href="/auth/redirect">Login with GitHub</a></p>
    <p><a href="/signup">Create an account</a></p>
@endsection