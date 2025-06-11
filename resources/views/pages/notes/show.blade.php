@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <div class="card shadow-sm bg-light border-0">
            <div class="card-body">
                <h5 class="card-title">Note Details</h5>
                <p class="card-text">{{ $note->content }}</p>

                @if ($note->created_at)
                    <p class="text-muted">
                        Created on: {{ $note->created_at->format('Y-m-d H:i') }}
                    </p>
                @else
                    <p class="text-muted">Created at: N/A</p>
                @endif

                <p>
                    <strong>Linked to:</strong>
                    @if ($note->client or $note->order)
                        Client: <a href="{{ route('clients.show', $note->client_id) }}">{{ $note->client->name }}</a>
                    @elseif ($note->order)
                        Order: <a href="{{ route('orders.show', $note->order_id) }}">#{{ $note->order->id }} - {{ $note->order->title }}</a>
                    @else
                        N/A
                    @endif
                </p>

                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back to all Notes</a>
                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary">Edit</a>

                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this note?')" class="btn btn-danger">
                        Delete
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
