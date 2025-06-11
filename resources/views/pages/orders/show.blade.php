@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100">

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ✅ Order Header --}}
        @php
            $status = strtolower($order->status->status);
            $badgeClass = match($status) {
                'pending' => 'bg-warning',
                'approved' => 'bg-primary',
                'completed' => 'bg-success',
                'cancelled', 'rejected' => 'bg-danger',
                default => 'bg-secondary',
            };
        @endphp

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center {{ $badgeClass }}">
                <h5 class="mb-0">Order #{{ $order->id }} - {{ $order->title }}</h5>
                <span class="badge {{ $badgeClass }}">
                {{ $order->status->status }}
            </span>
            </div>

            <div class="card-body">
                <p><strong>Description:</strong> {{ $order->description }}</p>
                <p><strong>Amount:</strong> €{{ number_format($order->amount, 2) }}</p>
                <p><strong>Finished At:</strong>
                    {{ $order->finished_at ? $order->finished_at->format('Y-m-d') : '—' }}
                </p>
                <p><strong>Client:</strong>
                    <a href="{{ route('clients.show', $order->client->id) }}">
                        {{ $order->client->name }}
                    </a>
                </p>
            </div>
        </div>

        {{-- ✅ Tasks --}}
        @if($order->tasks->count())
            <div class="mb-4">
                <h5>Tasks</h5>
                @foreach($order->tasks as $task)
                    <a href="{{ route('tasks.show', $task->id) }}" class="text-decoration-none d-block mb-2 note-hover">
                        <div class="card bg-light shadow-sm border-0">
                            <div class="card-body py-2">
                                <small class="text-muted">{{ optional($task->due_date)->format('Y-m-d') }}</small>
                                <p class="mb-0 text-dark">{{ Str::limit($task->title, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- ✅ Notes --}}
        @if($order->notes->count())
            <div>
                <h5>Notes</h5>
                @foreach($order->notes as $note)
                    <a href="{{ route('notes.show', $note->id) }}" class="text-decoration-none d-block mb-2 note-hover">
                        <div class="card bg-light shadow-sm border-0">
                            <div class="card-body py-2">
                                <small class="text-muted">{{ $note->created_at->format('Y-m-d') }}</small>
                                <p class="mb-0 text-dark">{{ Str::limit($note->content, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
@endsection
