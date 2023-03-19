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
    <div class="card">
        <div class="card-header">
            <h3 style="font-size: 24px;" class="text-primary text-center mt-5"><strong>{{ $post->title }}</strong></h3>
            <span>Category : {{ $post->category->title }}</span><span class="mx-3 text-theme-28">|</span>
            <span>Sub Category : {{ $post->subCategory->title }}</span><span class="mx-3 text-theme-28">|</span>
            <span>Views : {{ $post->view_count }}</span>
            <div class="card-body">
                {!! $post->content !!}
            </div>
            <div class="mt-3">
                <img src="{{ getImage($post->featured_img) }}" alt="{{ $post->slug }}">

            </div>
        </div>
    </div>
@endsection
@push('customJs')
@endpush
