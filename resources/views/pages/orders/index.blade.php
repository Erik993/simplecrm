@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <h2 class="mb-4">Orders</h2>

        <div class="row row-cols-1 row-cols-md-{{ count($statuses) }} g-4">
            @foreach ($statuses as $status)
                @php
                    // Define a Bootstrap color class per status name
                    $colorClass = match(strtolower($status->status)) {
                        'pending' => 'bg-dark text-white',
                        'in progress' => 'bg-info text-white',
                        'send invoice' => 'bg-primary text-white',
                        'delivered' => 'bg-success text-white',
                        'completed' => 'bg-warning text-white',
                        'cancelled' => 'bg-danger text-white',
                        default => 'bg-secondary text-white'
                    };
                @endphp

                <div class="col">
                    <h5 class="text-center {{ $colorClass }} py-2 rounded">
                        {{ $status->status }}
                    </h5>

                    @foreach ($ordersByStatus[$status->id] ?? [] as $order)
                        <a href="{{ route('orders.show', $order->id) }}" class="note-hover text-decoration-none d-block mb-3">
                            <div class="card shadow-sm border-0 bg-light h-100">
                                <div class="card-body py-2">
                                    <small class="text-muted">
                                        {{ $order->finished_at ? \Carbon\Carbon::parse($order->finished_at)->format('Y-m-d') : 'No finish date' }}
                                    </small>
                                    <p class="mb-1 fw-bold text-dark">{{ $order->title }}</p>
                                    <p class="mb-0 text-muted">€{{ number_format($order->amount, 2) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
@endsection

