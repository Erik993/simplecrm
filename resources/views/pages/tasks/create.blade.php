@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow rounded border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Create New Task</h5>
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

                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Task Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Task Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>



                            <div class="row">
                                {{-- Show only Client if $clientId is set --}}
                                @if (!$clientId)
                                    <div class="col-md-6 mb-3">
                                        <label for="order_id" class="form-label">Order</label>
                                        <select name="order_id" class="form-select" required>
                                            <option value="">Select Order</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->title ?? 'Order' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if ($clientId)
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Client</label>
                                        <input type="text" class="form-control" value="{{ $client->name }}" disabled>
                                    </div>
                                @elseif (!$orderId)
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Select Client</label>
                                        <select name="client_id" class="form-select" required>
                                            <option value="">Select...</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="task_status_id" class="form-label">Status</label>
                                    <select name="task_status_id" class="form-select w-50" required>
                                        <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('task_status_id') == $status->id ? 'selected' : '' }}>
                                                {{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control w-50" value="{{ old('due_date') }}" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
