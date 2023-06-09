@extends('layouts.frontendapp')
@php
    function readMore($post)
    {
        $value = "<a href='/post/$post->id' style='color: var(--bs-red);'>...Read More</a>";
        return $value;
    }
@endphp
@section('content')
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">{{ str()->headline($category->title) }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a>
                        </li>

                        @if (isset($category->subCategories))
                            <li class="breadcrumb-item active" aria-current="page">
                                <a
                                    href="{{ route('frontend.category', $category->id) }}">{{ str()->headline($category->title) }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route('frontend.category', $category->category->id) }}">
                                    {{ str()->headline($category->category->title) }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('frontend.category', $category->id) }}">
                                    {{ str()->headline($category->title) }}
                                </a>
                            </li>
                        @endif

                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <div class="row gy-4">

                        @forelse ($posts as $post)
                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        @isset($post->type)
                                            <a href="{{ route('frontend.show', $post) }}"
                                                class="category-badge position-absolute">{{ $post->type }}</a>
                                        @endisset
                                        <a href="{{ route('frontend.show', $post) }}">
                                            <div class="inner">
                                                <img src="{{ setImage($post->featured_img) }}"
                                                    alt="{{ $post->slug }}" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><img
                                                        src="{{ setImage($post->user->avatar) }}" class="author avatar"
                                                        alt="author" />{{ $post->user->name }}</a></li>
                                            <li class="list-inline-item">
                                                {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                            </li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3">
                                            <a href="{{ route('frontend.show', $post) }}">{{ $post->title }}</a>
                                        </h5>
                                        <p class="excerpt mb-0">
                                            {!! Str::limit($post->content, 100, readMore($post)) !!}
                                        </p>
                                    </div>
                                    <div class="post-bottom clearfix d-flex align-items-center">
                                        <div class="social-share me-auto">
                                            <button class="toggle-button icon-share"></button>
                                            <ul class="icons list-unstyled list-inline mb-0">
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="fab fa-twitter"></i></a></li>
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="fab fa-pinterest"></i></a></li>
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="fab fa-telegram-plane"></i></a></li>
                                                <li class="list-inline-item"><a href="category.html#"><i
                                                            class="far fa-envelope"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="more-button float-end">
                                            <a href="blog-single.html"><span class="icon-options"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-center">No posts found</h3>
                        @endforelse



                    </div>

                    {{ $posts->links() }}
                </div>
                @include('layouts.fronendSidebar')

            </div>

        </div>
    </section>
@endsection
