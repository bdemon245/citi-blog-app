@extends('layouts.backendapp')
@section('backendContent')


<div class="row">
    <div class="col-lg-4">
        @if (isset($editedCategory))
        <div class="card">
            <div class="card-header">Edit Sub-Category</div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf

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
            <div class="card-header">Add Sub-Category</div>
            <div class="card-body">
                <form action="{{ route('category.sub.store') }}" method="POST">
                    @csrf
                    <input type="text" name="title" class="form-control mt-3 " placeholder="Category Title">
                    @error('title')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <input type="text" name="slug" class="form-control mt-3 mb-3" placeholder="Category Slug">
                    @error('slug')
                    <span style="color: red">{{ $message }}</span>
                    @enderror

                    <select name="category_id" class="form-control">
                        <option disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span style="color: red">{{ $message }}</span>
                    @enderror

                    <button class="btn btn-primary mt-3">Add Sub-Category</button>
                </form>
            </div>
        </div>
        @endif





    </div>
    <div class="col-lg-8">

        <table class="table table-responsive">
            <tr>
                <th>#</th>
                <th>Sub-Category Title</th>
                <th>Parent</th>
                <th>Actions</th>
            </tr>

            @forelse ($subcategories as $key=>$subcategory)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $subcategory->title }}</td>
                <td>{{ $subcategory->category->title }}</td>
                <td>
                    <div class="btn-group">
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm deleteButton">Delete</a>

                        <form action="{{ route('category.sub.delete', $subcategory) }}" method="POST">
                            @csrf
                            @method('DELETE')

                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No Sub Found</td>
            </tr>
            @endforelse


        </table>


    </div>
</div>



@endsection

@push('customJs')
<script>
    $('.deleteButton').click( function(){
Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
    $(this).next('form').submit();
}
})
    } )


       
</script>
@endpush