@extends('layouts.backendapp')
@section('backendContent')
    <div class="col-lg-6 mt-5 mx-auto">
        <div class="card">
            <div class="card-header">Add User</div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <input class="form-control" type="text" name="name" placeholder="Name">
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <input class="form-control" type="text" name="email" placeholder="Email">
                    @error('email')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <input class="form-control" type="password" name="password" placeholder="Password">
                    @error('password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <select name="role" class="form-control">
                        <option disabled selected>Select a Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ str()->headline($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <button class="btn btn-primary" style="width:100%; margin-top: 15px;">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <div class="mt-5 container">
        <table class="table table-responsive">
            <tr>
                <th>#</th>
                <th>Users Name</th>
                <th>Users Role</th>
                <th>Actions</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span style="margin:0 5px">{{ str()->headline($role->name) }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if ($user->status == 1)
                            <a href=""
                                class="btn-danger btn btn-sm {{ $user->id == auth()->user()->id ? 'disabled' : '' }}">Ban
                                User</a>
                        @else
                            <a href=""
                                class="btn-success btn btn-sm {{ $user->id == auth()->user()->id ? 'disabled' : '' }}">Active
                                User</a>
                        @endif

                    </td>
                </tr>
            @endforeach


        </table>
    </div>
@endsection
