@extends('layouts.main')

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
<input for="name" type="text" name="name" id="name">
<label for="password">Password:</label>
<input for="password" type="password" name="password" id="password">
<button type="submit">Register</button>
</form>