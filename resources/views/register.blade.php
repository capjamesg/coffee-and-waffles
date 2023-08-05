@extends('layouts.main')

<form method="POST" action="/signup">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="name">Username:</label>
    <input for="name" type="text" name="name" id="name">
    <label for="email">Email:</label>
    <input for="email" type="email" name="email" id="email">
    <label for="password">Password:</label>
    <input for="password" type="password" name="password" id="password">
    <button type="submit">Register</button>
</form>