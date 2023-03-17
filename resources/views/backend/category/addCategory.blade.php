@extends('layouts.backendapp')
@section('backendContent')


<div class="row">
    <div class="col-lg-4">
        @if (isset($editedCategory))
        <div class="card">
            <div class="card-header">Edit Category</div>
            <div class="card-body">
                <form action="{{ route('category.update', $editedCategory) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" class="form-control mt-3 " placeholder="Category Title"
                        value="{{ $editedCategory->title }}">
                    @error('title')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <input type="text" name="slug" class="form-control mt-3 mb-3" placeholder="Category Slug" value="">
                    @error('slug')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <input type="text" name="title" class="form-control mt-3 " placeholder="Category Title">
                    @error('title')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <input type="text" name="slug" class="form-control mt-3 mb-3" placeholder="Category Slug">
                    @error('slug')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
        @endif





    </div>
    <div class="col-lg-8">

        <table class="table table-responsive">
            <tr>
                <th>#</th>
                <th>Category Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
            @foreach ($categories as $key=>$category)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('category.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('category.delete', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>

            @foreach ($category->subcategories as $sub)
            <tr>
                <td><i data-feather="corner-down-right"></i></td>
                <td>{{ $sub->title }}</td>
                <td colspan="2">{{ $sub->slug }}</td>

            </tr>

            @endforeach
            @endforeach

        </table>


    </div>
</div>



@endsection