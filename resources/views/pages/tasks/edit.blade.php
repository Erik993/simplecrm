@extends('layouts.app')

@section('content')

    {{-- Success--}}
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="container-fluid bg-light min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow rounded border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Task</h5>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="title" class="form-label">Task Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Task Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                            </div>

                            <div class="row">
                                {{-- If task is linked to order, show order info --}}
                                @if ($task->order_id)
                                    <input type="hidden" name="order_id" value="{{ $task->order_id }}">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Order</label>
                                        <input type="text" class="form-control" value="#{{ $task->order->id }} - {{ $task->order->title ?? 'Order' }}" disabled>
                                    </div>
                                @elseif ($task->client_id)
                                    <input type="hidden" name="client_id" value="{{ $task->client_id }}">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client</label>
                                        <input type="text" class="form-control" value="{{ $task->client->name }}" disabled>
                                    </div>
                                @else
                                    {{-- fallback, show client select --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Select Client</label>
                                        <select name="client_id" class="form-select" required>
                                            <option value="">Select...</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" {{ $task->client_id == $client->id ? 'selected' : '' }}>
                                                    {{ $client->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="user_id" class="form-label">User</label>
                                    <select name="user_id" class="form-select w-50" required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="task_status_id" class="form-label">Status</label>
                                    <select name="task_status_id" class="form-select w-50" required>
                                        <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $task->task_status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control w-50" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Task</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

