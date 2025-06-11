@extends('layouts.guest')

@section('content')
    <div class="container">

        <h2>Register New User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            {{-- Always admin by default --}}
            <input type="hidden" name="role" value="admin">


            <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-primary"> Register </button>
                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i> Back to Welcome
                </a>
            </div>

        </form>
    </div>
@endsection
