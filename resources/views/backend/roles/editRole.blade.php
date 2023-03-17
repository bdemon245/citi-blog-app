@extends('layouts.backendapp')
@section('backendContent')

<div class="col-lg-6 mt-5 mx-auto">
    <div class="card">
        <div class="card-header">Edit Role</div>
        <div class="card-body">
            <form action="{{ route('role.update', $role->id) }}" method="POST">
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
        <div class="col-md-3" style="margin: 12px 0;">
            
            <input type="checkbox" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                {{ $hasPermissions->search($permission->id) ? 'checked' : '' }}
                name="permissions[]">
            <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
        </div>
        @endforeach

    </div>


</div>
</div>

</form>
@endsection