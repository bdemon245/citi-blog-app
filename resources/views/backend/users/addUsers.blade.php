@extends('layouts.backendapp')
@section('backendContent')

<div class="col-lg-6 mt-5 mx-auto">
    <div class="card">
        <div class="card-header">Add User</div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="name" placeholder="User Name">
                @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
                <input class="form-control" type="text" name="email" placeholder="User Email">
                @error('email')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
                <input class="form-control" type="text" name="password" placeholder="User Password">
                @error('password')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
                <select name="role" class="form-control">
                    <option disabled selected>Select a Role</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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


<div class="mt-5">
    <table class="table table-responsive">
        <tr>
            <th>#</th>
            <th>Users Name</th>
            <th>Users Role</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->roles->first()->name }}</th>
            <th>
                @if ($user->status == 1)
                    <a href="{{ route('users.ban', $user->id) }}"
                        class="btn-danger btn btn-sm {{ $user->id == auth()->user()->id ? 'disabled' : '' }}">Ban
                        User</a>
                @else
                <a href="{{ route('users.ban', $user->id) }}"
                    class="btn-success btn btn-sm {{ $user->id == auth()->user()->id ? 'disabled' : '' }}">Active 
                    User</a>
                @endif
              
            </th>
        </tr>
        @endforeach


    </table>
</div>


@endsection