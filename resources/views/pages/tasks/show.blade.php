@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Task: {{ $task->title }}</h5>

                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ match($task->status?->status) {
                                'New' => 'info',
                                'In Progress' => 'primary',
                                'Completed' => 'success',
                                'Cancelled' => 'danger',
                                default => 'secondary'
                            } }}">
                                {{ $task->status?->status ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <strong>Description:</strong>
                            <p class="mt-1">{{ $task->description ?? 'No description provided.' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Assigned User:</strong>
                            <span>{{ $task->user?->name ?? 'Unassigned' }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Created at:</strong> {{ $task->created_at->format('Y-m-d H:i') }}<br>
                            <strong>Last updated:</strong> {{ $task->updated_at->format('Y-m-d H:i') }}
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('clients.show', $task->client_id) }}" class="btn btn-secondary">Back to Client</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
