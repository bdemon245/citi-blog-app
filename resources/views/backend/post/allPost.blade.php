@extends('layouts.backendapp')

@push('customCss')
<style>

</style>
@endpush

@section('backendContent')
<h2 class="fs-xl mt-3">All Posts</h2>

<table class="table table-responsive">
    <tr>
        <th>#</th>
        <th>Featured Image</th>
        <th>Title</th>
        <th>Actions</th>
    </tr>

    @foreach ($posts as $key=>$post)
    <tr>
        <td>{{ ++$key }}</td>
        <td><img src="{{ asset('storage/'.$post->featured_img) }}" alt="{{ $post->title }}" style="max-height: 120px;border-radius: 10px;"></td>
        <td>{{ $post->title }}</td>
        <td>
            <a href="" class="btn btn-primary btn-sm">Edit</a>
            <a href="" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach
</table>




@endsection
@push('customJs')

@endpush