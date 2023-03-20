@extends('layouts.backendapp')

@php
    function isChecked($hasPermissions, $permissionId)
    {
        $value = false;
        if ($hasPermissions->search($permissionId) !== false) {
            $value = true;
        }
        return $value;
    }
@endphp
@section('backendContent')
    <div class="col-lg-6 mt-5 mx-auto">
        <div class="card">
            <div class="card-header">Edit Role</div>
            <div class="card-body">
                <form action="{{ route('role.update', $role) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input class="form-control" type="text" name="role" value="{{ $role->name }}">
                    @error('role')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <button class="btn btn-primary" style="width:100%; margin-top: 15px;">Update Role & Permission</button>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">


            <h5>All Permissions</h5>



        </div>
    </div>
    <div class="card-body">

        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-lg-3 form-check form-switch" style="margin: 12px 0;">

                    <input class="form-check-input" type="checkbox" role="switch" name="permissions[]"
                        id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                        {{ isChecked($hasPermissions, $permission->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                        <h4><strong>{{ str()->headline($permission->name) }}</strong></h4>
                    </label>
                </div>
            @endforeach

        </div>


    </div>
    </div>

    </form>
@endsection
