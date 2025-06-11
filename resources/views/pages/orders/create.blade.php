@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Create New Order</h5>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>OOOps</strong> There were problems with your input.
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf

                            @if ($clientId)
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" value="{{ $client->name }}" disabled>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="order_status_id" class="form-label">Status</label>
                                <select name="order_status_id" class="form-select" required>
                                    <option value="">Select Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ old('order_status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Order Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" step="0.01" value="{{ old('amount') }}">
                            </div>

                            <div class="mb-3">
                                <label for="finished_at" class="form-label">Finished At (optional)</label>
                                <input type="date" name="finished_at" class="form-control" value="{{ old('finished_at') }}">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
