@extends('layouts.frontendapp')

@section('content')
    <section class="hero-carousel">
        <div class="container-xl">
            <div class="post-carousel-lg">
                <!-- post banners -->
                @foreach ($banners as $banner)
                    <div class="post featured-post-xl">
                        <div class="details clearfix">
                            <a href="{{ route('frontend.category', $banner->category_id) }}"
                                class="category-badge lg">{{ $banner->category->title }}</a>
                            <h4 class="post-title"><a
                                    href="{{ route('frontend.show', $banner) }}">{{ $banner->title }}</a>
                            </h4>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item"><a
                                        href="{{ route('frontend.show', $banner) }}">{{ $banner->user->name }}</a></li>
                                <li class="list-inline-item">
                                    {{ Carbon\Carbon::parse($banner->created_at)->diffForHumans() }}</li>
                            </ul>
                        </div>
                        <a href="{{ route('frontend.show', $banner) }}">
                            <div class="thumb rounded">
                                <div class="inner data-bg-image" data-bg-image="{{ setImage($banner->featured_img) }}">
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <!-- post -->
                    @foreach ($posts as $post)
                        <div class="post post-classic rounded bordered">
                            <div class="thumb top-rounded">
                                <a href="{{ route('frontend.category', $post->category) }}"
                                    class="category-badge lg position-absolute">{{ $post->category->title }}</a>
                                <span class="post-format">
                                    <i class="icon-picture"></i>
                                </span>
                                <a href="{{ route('frontend.show', $post) }}">
                                    <div class="inner">
                                        <img src="{{ setImage($post->featured_img) }}" alt="post-title" />
                                    </div>
                                </a>
                            </div>
                            <div class="details">
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><img
                                                src="{{ setImage($post->user->avatar) }}" class="author avatar"
                                                alt="author" />{{ $post->user->name }}</a></li>
                                    <li class="list-inline-item">
                                        {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</li>
                                    <li class="list-inline-item"><i class="icon-bubble"></i>
                                        ({{ count($post->comments) + countReplies($post->comments) }})
                                    </li>
                                </ul>
                                <h5 class="post-title mb-3 mt-3"><a href="{{ route('frontend.show', $post) }}">{{ $post->title }}</a></h5>
                                <p class="excerpt mb-0">{!! Str::limit($post->content, 200, '...') !!}</p>
                            </div>
                            <div class="post-bottom clearfix d-flex align-items-center">
                                <div class="social-share me-auto">
                                    <button class="toggle-button icon-share"></button>
                                    <ul class="icons list-unstyled list-inline mb-0">
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="fab fa-pinterest"></i></a></li>
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="fab fa-telegram-plane"></i></a></li>
                                        <li class="list-inline-item"><a href="{{route("frontend.home")}}"><i
                                                    class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="float-end d-none d-md-block">
                                    <a href="{{ route('frontend.show', $post) }}" class="more-link">Continue reading<i
                                            class="icon-arrow-right"></i></a>
                                </div>
                                <div class="more-button d-block d-md-none float-end">
                                    <a href=""><span class="icon-options"></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{ $posts->links() }}


                </div>
                @include('layouts.fronendSidebar')
            </div>

        </div>
    </section>

    <!-- instagram feed -->
    <div class="instagram">
        <div class="container-xl">
            <!-- button -->
            <a href="{{route("frontend.home")}}" class="btn btn-default btn-instagram">@Katen on Instagram</a>
        </div>
    </div>
@endsection
