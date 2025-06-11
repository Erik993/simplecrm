@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-4">All Notes</h3>
        </div>


        <div class="row">

            @forelse($notes as $note)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-0" >
                        <div class="card-body">
                            <div class="mb-2">
                                <small class="text-muted">{{ $note->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                            <p class="mb-1">{{ $note->content }}</p>

                            @if ($note->client)
                                <span class="badge bg-info ">Client: {{ $note->client->name }}</span>
                            @elseif ($note->order)
                                <span class="badge bg-secondary">Order: #{{ $note->order->id }}</span>
                            @else
                                <span class="badge bg-danger">Unassigned</span>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                            {{--<a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>--}}
                        </div>
                    </div>
                </div>
            @empty
                <p>No notes found.</p>
            @endforelse
        </div>
    </div>
@endsection
