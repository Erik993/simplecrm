@extends('layouts.app')
@section('content')

    <div class="container-fluid bg-light min-vh-100">
        <h3 class="mb-4 mb-3">Client {{$client->name}} Card</h3>

        <div class="card shadow-sm h-100 border-light {{ $client->status?->getColorClass() }}">
            <div class="card-body">
                <div class="row">
                    {{--Client card--}}
                    <div class="col-md-4">
                        <h5 class="card-title">{{ $client->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $client->email }}</h6>

                        <p class="card-text">
                            <strong>Phone:</strong> {{ $client->phone }} <br>
                            <strong>Company:</strong> {{ $client->company_name ?? 'N/A' }} <br>

                            @if($client->status)
                                @if($client->status->status === 'New')
                                    <strong>Status:</strong> <span
                                        class="badge bg-info">{{ $client->status->status }}</span>
                                @elseif($client->status->status === 'Active')
                                    <strong>Status:</strong> <span
                                        class="badge bg-success">{{ $client->status->status }}</span>
                                @elseif($client->status->status === 'Inactive')
                                    <strong>Status:</strong> <span
                                        class="badge bg-warning">{{ $client->status->status }}</span>
                                @elseif($client->status->status === 'Banned')
                                    <strong>Status:</strong> <span
                                        class="badge bg-danger">{{ $client->status->status }}</span>
                                @else
                                    <strong>Status:</strong> <span
                                        class="badge bg-secondary">{{ $client->status->status }}</span>
                                @endif
                            @endif

                            <br>
                            <strong>Assigned User:</strong> {{ $client->user->name ?? 'N/A' }}
                        </p>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to Clients</a>

                            @can('edit', \App\Models\Client::class)
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Edit</a>
                            @endcan

                            @can('delete', $client)
                                {{-- You could use policies too, but for simplicity: --}}
                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endif
                            @endcan
                        </div>
                    </div>
                    {{--Client card--}}

                    {{--Notes, Tasks, Orders--}}
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('notes.create', ['client_id' => $client->id]) }}" class="btn btn-info mb-2">Add Note</a>
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="card-title text-uppercase fw-bold">Note History</h6>
                                        @forelse ($client->notes as $note)

                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                {{-- Note clickable card --}}
                                                <a href="{{ route('notes.show', $note->id) }}" class="note-hover text-decoration-none flex-grow-1">
                                                    <div class="card shadow-sm border-0 bg-light">
                                                        <div class="card-body py-2">
                                                            <small class="text-muted">{{ $note->created_at->format('Y-m-d') }}</small>
                                                            <p class="mb-0 text-dark">{{ Str::limit($note->content, 50) }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                {{-- Delete button --}}
                                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <button type="submit" onclick="return confirm('Delete this note?')" class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @empty
                                            <p class="text-muted">No notes</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

{{------------------------------------------------task---------}}
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('tasks.create', ['client_id' => $client->id]) }}" class="btn btn-info mb-2">Add Task</a>
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="card-title text-uppercase fw-bold">Task History</h6>
                                        @forelse ($client->tasks as $task)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <a href="{{ route('tasks.show', $task->id) }}" class="note-hover text-decoration-none flex-grow-1">
                                                    <div class="card shadow-sm border-0 bg-light">
                                                        <div class="card-body py-2">
                                                            <small class="text-muted">{{ $task->created_at->format('Y-m-d') }}</small>
                                                            <div class="mb-0 text-dark">{{ $task->title }}</div>
                                                            <div class="text-dark"><strong>Status:</strong> {{ $task->status?->status ?? 'N/A' }}</div>
                                                            <div class="text-dark"><strong>Due:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <button type="submit" onclick="return confirm('Delete this task?')" class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @empty
                                            <p class="text-muted">No tasks</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
{{----------------------------------------------------order---------------------------}}
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('orders.create', ['client_id' => $client->id]) }}" class="btn btn-info mb-2">Add Order</a>
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="card-title text-uppercase fw-bold">Order History</h6>
                                        @forelse ($client->orders as $order)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <a href="{{ route('orders.show', $order->id) }}" class="note-hover text-decoration-none flex-grow-1">
                                                    <div class="card shadow-sm border-0 bg-light">
                                                        <div class="card-body py-2">
                                                            <small class="text-muted">{{ $order->created_at->format('Y-m-d') }}</small>
                                                            <div class="fw-semibold text-dark">Order #{{ $order->id }}</div>
                                                            <div class="text-dark mb-1">{{ $order->title }}</div>
                                                            <div class="text-dark"><strong>Status:</strong> {{ $order->status?->status ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    <button type="submit" onclick="return confirm('Delete this order?')" class="btn btn-sm btn-outline-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @empty
                                            <p class="text-muted">No orders</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
