@extends('layouts.guest')
@section('content')

    <div class="container text-cente">
        <h2>Login</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-primary">Login</button>
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i> Back to Welcome
                </a>
            </div>



        </form>
    </div>
@endsection

