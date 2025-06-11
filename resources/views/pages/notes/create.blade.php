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

                        <form action="{{ route('notes.store') }}" method="POST">
                            @csrf
                            @if ($clientId)
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" value="{{ $client->name }}" disabled>
                                </div>
                            @else
                                <!-- Optional: select client manually -->
                                <div class="mb-3">
                                    <label class="form-label">Select Client</label>
                                    <select name="client_id" class="form-select">
                                        <option value="">Select...</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Content field -->
                            <div class="mb-3">
                                <label class="form-label">Note Content</label>
                                <textarea name="content" class="form-control" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Note</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
