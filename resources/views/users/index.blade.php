@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100 py-5">
        <h2 class="mb-4">User list</h2>

        {{-- Успешное сообщение --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div><strong>User count: {{ $users->count() }}</strong></div>
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Add New User
            </a>
        </div>

        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th style="width: 150px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-capitalize">{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
