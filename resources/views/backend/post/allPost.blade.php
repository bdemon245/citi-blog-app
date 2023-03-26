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
            <th>Author</th>
            <th>Banner Status</th>
            <th>Actions</th>
        </tr>

        @foreach ($posts as $key => $post)
            <tr>
                <td>{{ ++$key }}</td>
                <td><img src="{{ setImage($post->featured_img) }}" alt="{{ $post->title }}"
                        style="max-height: 120px;border-radius: 10px;">
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
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
                        @can('toggle post')
                            <form action="{{ route('post.toggleBanner', $post) }}" method="post">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-dark btn-sm">Toggle</button>
                            </form>
                        @endcan
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('post.show', $post) }}" class="btn btn-dark btn-sm">View</a>
                        @can('update post')
                            <a href="{{ route('post.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                        @endcan
                        @can('delete post')
                            <form action="{{ route('post.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="mt-3">
        {{ $posts->links() }}
    </div>
@endsection
@push('customJs')
@endpush
