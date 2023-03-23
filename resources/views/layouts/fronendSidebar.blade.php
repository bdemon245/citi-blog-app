@extends('layouts.frontendapp')
@section('sidebar')
    <div class="col-lg-4">

        <!-- sidebar -->
        <div class="sidebar">
            <!-- widget about -->
            <div class="widget rounded">
                <div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
                    <img src="{{ asset('frontend/images/logo.svg') }}" alt="logo" class="mb-4" />
                    <p class="mb-4">Hello, We’re content writer who is fascinated by content fashion, celebrity
                        and lifestyle. We helps clients bring the right content to the right people.</p>
                    <ul class="social-icons list-unstyled list-inline mb-0">
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-medium"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="category.html#"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- widget popular posts -->
            <div class="widget rounded">
                <div class="widget-header text-center">
                    <h3 class="widget-title">Popular Posts</h3>
                    <img src="images/wave.svg" class="wave" alt="wave" />
                </div>
                <div class="widget-content">
                    @forelse ($popularPosts as $key=> $post)
                        <!-- post -->
                        <div class="post post-list-sm circle">
                            <div class="thumb circle">
                                <span class="number">{{ ++$key }}</span>
                                <a href="{{ route('frontend.show', $post) }}">
                                    <div class="inner">
                                        <img class="author avatar" src="{{ setImage($post->user->avatar) }}"
                                            alt="{{ $post->user->name }}" />
                                    </div>
                                </a>
                            </div>
                            <div class="details clearfix">
                                <h6 class="post-title my-0"><a
                                        href="{{ route('frontend.show', $post) }}">{{ $post->title }}</a></h6>
                                <ul class="meta list-inline mt-1 mb-0">
                                    <li class="list-inline-item">
                                        {{ Carbon\Carbon::parse($post->created_at)->format('d M Y') }}/li>
                                </ul>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

            <!-- widget categories -->
            <div class="widget rounded">
                <div class="widget-header text-center">
                    <h3 class="widget-title">Explore Topics</h3>
                    <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
                </div>
                <div class="widget-content">
                    <ul class="list">
                        @foreach ($categories as $category)
                            <li><a
                                    href="{{ route('frontend.category', $category->id) }}">{{ $category->title }}</a><span>{{ recordsCount('posts', [['category_id', '=', $category->id]]) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <!-- widget newsletter -->
            <div class="widget rounded">
                <div class="widget-header text-center">
                    <h3 class="widget-title">Newsletter</h3>
                    <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
                </div>
                <div class="widget-content">
                    <span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
                    <form>
                        <div class="mb-2">
                            <input class="form-control w-100 text-center" placeholder="Email address…" type="email">
                        </div>
                        <button class="btn btn-default btn-full" type="submit">Sign Up</button>
                    </form>
                    <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a
                            href="category.html#">Privacy Policy</a></span>
                </div>
            </div>
            <!-- widget advertisement -->
            <div class="widget no-container rounded text-md-center">
                <span class="ads-title">- Sponsored Ad -</span>
                <a href="category.html#" class="widget-ads">
                    <img src="images/ads/ad-360.png" alt="Advertisement" />
                </a>
            </div>

            <!-- widget tags -->
            <div class="widget rounded">
                <div class="widget-header text-center">
                    <h3 class="widget-title">Tag Clouds</h3>
                    <img src="images/wave.svg" class="wave" alt="wave" />
                </div>
                <div class="widget-content">
                    <a href="category.html#" class="tag">#Trending</a>
                    <a href="category.html#" class="tag">#Video</a>
                    <a href="category.html#" class="tag">#Featured</a>
                    <a href="category.html#" class="tag">#Gallery</a>
                    <a href="category.html#" class="tag">#Celebrities</a>
                </div>
            </div>

        </div>

    </div>
@endsection
