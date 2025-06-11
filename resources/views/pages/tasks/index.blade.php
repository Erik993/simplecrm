@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-4">All Tasks</h2>
            {{--<a href="{{ route('tasks.create') }}" class="btn btn-success">+ Add New Task</a>--}}
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle bg-white shadow-sm rounded">
                <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Client</th>
                    <th>Order</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->user->name ?? 'N/A' }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            <span class="badge
                                @if($task->status?->status === 'Completed') bg-success
                                @elseif($task->status?->status === 'In progress') bg-info
                                @elseif($task->status?->status === 'Pending') bg-warning
                                @else bg-secondary @endif">
                                {{ $task->status?->status ?? 'N/A' }}
                            </span>
                        </td>
                        <td>{{ $task->client->name ?? 'N/A' }}</td>
                        <td>{{ $task->order->title ?? 'N/A' }}</td>
                        <td>{{ $task->due_date?->format('Y-m-d') ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted text-center">No tasks found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
