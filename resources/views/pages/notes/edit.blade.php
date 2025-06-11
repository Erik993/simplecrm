@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Create a New Note</h5>
                    </div>
                    <div class="card-body">

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('notes.update', $note->id) }}">
                            @csrf
                            @method('PATCH')

                            {{-- Content --}}
                            <div class="mb-3">
                                <label for="content" class="form-label">Note Content</label>
                                <textarea name="content" id="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="Write your note here...">{{ old('content', $note->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Client --}}
                            @if ($client)
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" value="{{ $client->name }}" disabled>
                                </div>
                            @endif


                            {{-- Order --}}
                            @if ($note->order)
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Order</label>
                                    <input type="text" class="form-control" value="Order #{{ $order->id }} — {{ $order->title }}" disabled>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Update Note
                            </button>
                            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back to Notes</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
