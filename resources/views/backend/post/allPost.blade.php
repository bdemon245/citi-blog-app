@extends('layouts.backendapp')
@php
    function getImage(string $imgUrl)
    {
        if (Str::contains($imgUrl, 'uploads/')) {
            $imgUrl = asset('storage/' . $imgUrl);
        }
        return $imgUrl;
    }
@endphp
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
            <th>Banner Status</th>
            <th>Actions</th>
        </tr>

        @foreach ($posts as $key => $post)
            <tr>
                <td>{{ ++$key }}</td>
                <td><img src="{{ getImage($post->featured_img) }}" alt="{{ $post->title }}"
                        style="max-height: 120px;border-radius: 10px;">
                </td>
                <td>{{ $post->title }}</td>
                <td>
                    <div class="d-flex gap-2 align-items-center">
                        <div>
                            @if ($post->is_banner)
                                <span
                                    style="background: rgb(95, 255, 47); padding:5px 10px; color:rgb(110, 110, 110);border-radius:5px;">Active</span>
                            @else
                                <span
                                    style="background: rgb(255, 230, 0); padding:5px 10px; color:gray;border-radius:5px;">Inactive</span>
                            @endif
                        </div>
                        <form action="{{ route('post.toggleBanner', $post) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-dark btn-sm">Toggle</button>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('post.show', $post) }}" class="btn btn-dark btn-sm">View</a>
                        <a href="{{ route('post.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
@push('customJs')
@endpush
