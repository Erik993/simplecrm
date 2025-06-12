@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow">
                <form action="{{route('clients.store')}}" method="POST">
                    @csrf
                    <h3 class="mb-4">Add new Client</h3>

                    {{------------------Occurs if validation fails---------------------------}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-------------------------------------------------------------------------}}

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Client name"
                               value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email ">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com"
                               value="{{ old('email')}}">
                    </div>

                    {{-- Client statuses --}}
                    <div class="form-group mb-3">
                        <label for="clientStatus">Client status</label>
                        <select class="form-control" name="client_status_id" id="clientStatus">
                            @foreach ($clientStatuses as $status)
                                <option
                                    value="{{ $status->id }}" {{ old('client_status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="companyName ">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="CompanyName"
                               placeholder="Company name if exists" value="{{ old('company_name')}}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phoneNumber"
                               placeholder="+371-256-845-88" value="{{ old('phone')}}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="user_id">Assign to User</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
