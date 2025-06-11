@extends('layouts.app')
@section('content')
{{--occurs if new client is created succesfully--}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
{{--occurs if new client is created succesfully--}}

{{--filter--}}
<form method="GET" action="{{ route('clients.index') }}" class="mb-4">
    <div class="form-group">
        <label for="status_id">{{ __('clients.filter by status') }}</label>
        <select name="status_id" id="status_id" class="form-control w-25 d-inline-block">
            <option value="">All</option>
            @foreach ($ClientStatuses as $status)
                <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                    {{ $status->status }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary ml-2">{{ __('clients.filter') }}</button>
    </div>
</form>
{{--filter--}}

    <div class="container-fluid bg-light min-vh-100">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">{{ __('clients.all clients') }}</h2>

            @can('create', \App\Models\Client::class)
            <a href="{{ route('clients.create') }}" class="btn btn-success">+ {{ __('clients.add new client') }}</a>
            @endcan
        </div>


        @if($clients->isEmpty())
            <div class="alert alert-info">No clients found.</div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($clients as $client)


                    <div class="col">

                        <div class="card shadow-sm h-100 border-0 {{ $client->status?->getColorClass() }}">
                        <div class="card-body">
                                <h5 class="card-title fw-semibold">{{ $client->name }}</h5>
                                <p class="mb-1"><strong>Email:</strong> {{ $client->email }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $client->phone }}</p>
                                @if($client->status)
                                    <span class="badge
                                        @if($client->status->status === 'New') bg-info
                                        @elseif($client->status->status === 'Active') bg-success
                                        @elseif($client->status->status === 'Inactive') bg-warning
                                        @elseif($client->status->status === 'Banned') bg-danger
                                        @else bg-secondary
                                        @endif">
                                        {{ $client->status->status }}
                                    </span>
                                @endif
                                <br>
                                @if($client->user)
                                    <span class="badge bg-secondary">Responsible manager: {{ $client->user->name }}</span>
                                @endif
                            </div>

                            <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">

                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-outline-primary">View</a>

                                @can('view', $client)
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                @endcan
                            </div>

                        </div>
                    </div>


                @endforeach
            </div>
        @endif
    </div>
@endsection
