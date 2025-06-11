@extends('layouts.guest')

@section('content')
    <div class="text-center">
        <h1 class="mb-4">Welcome to SimpleCRM</h1>
        <a href="{{ route('login.form') }}" class="btn btn-primary me-2">Login</a>
        <a href="{{ route('register.form') }}" class="btn btn-outline-secondary">Register</a>
    </div>
@endsection
