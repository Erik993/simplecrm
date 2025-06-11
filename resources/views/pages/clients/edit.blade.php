@extends('layouts.app')
@section('content')
    <div class="container-fluid bg-light min-vh-100 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow">
                <form action="{{route('clients.update', $client->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h3 class="mb-4">Edit client</h3>

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
                               value="{{ old('name', $client->name) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email ">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com"
                               value="{{ old('email', $client->email)}}">
                    </div>

                    {{-- Client statuses --}}
                    <select name="client_status_id" class="form-select">
                        @foreach($clientStatuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('client_status_id', $client->client_status_id) == $status->id ? 'selected' : '' }}>
                                {{ $status->status }}
                            </option>
                        @endforeach
                    </select>

                    <div class="form-group mb-3">
                        <label for="companyName ">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="CompanyName"
                               placeholder="Company name if exists"
                               value="{{ old('company_name', $client->company_name)}}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phoneNumber">Phone number</label>
                        <input type="text" name="phone" class="form-control" id="phoneNumber"
                               placeholder="+371-256-845-88" value="{{ old('phone', $client->phone)}}">
                    </div>

                    @if(in_array(Auth::user()->role, ['admin', 'head']))
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Assigned User</label>
                            <select name="user_id" id="user_id" class="form-select">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            @if($client->user_id == $user->id) selected @endif>
                                        {{ $user->name }} ({{ $user->role }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary mb-3">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
