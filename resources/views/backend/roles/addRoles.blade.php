@extends('layouts.backendapp')
@section('backendContent')

<div class="col-lg-6 mt-5 mx-auto">
    <div class="card">
        <div class="card-header">Add New Role</div>
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <input class="form-control" type="text" name="role">
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
            <th>Role Name</th>
            <th>Actions</th>
        </tr>

        @foreach ($roles as $key=>$role)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $role->name }}</td>
            <td>
                @canany(['role create' , 'role edit'])

                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                @endcanany

            </td>
        </tr>
        @endforeach

    </table>
</div>


@endsection