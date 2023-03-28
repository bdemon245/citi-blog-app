<div class="col-lg-4">

    <!-- sidebar -->
    <div class="sidebar">
        <!-- widget about -->
        <div class="widget rounded">
            <div class="widget-about data-bg-image text-center" data-bg-image="{{ asset('frontend/images/map-bg.png') }}">
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
                <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
            </div>
            <div class="widget-content">
                @foreach (popular('posts', 'view_count', 3) as $key => $post)
                    <!-- post -->
                    <div class="post post-list-sm circle">
                        <div class="thumb">
                            <span class="number">{{ ++$key }}</span>
                            <a href="{{ route('frontend.show', $post->id) }}">
                                <div class="inner">
                                    <img src="{{ setImage($post->featured_img) }}" style="object-fit: contain;"
                                        alt="post-title" />
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a
                                    href="{{ route('frontend.show', $post->id) }}">{{ $post->title }}</a>
                            </h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">
                                    {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach

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

        <!-- widget post carousel -->
        <div class="widget rounded">
            <div class="widget-header text-center">
                <h3 class="widget-title">Celebration</h3>
                <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
            </div>
            <div class="widget-content">
                <div class="post-carousel-widget">
                    @foreach (randomPosts(['user', 'category', 'subCategory']) as $post)
                        <!-- post -->
                        <div class="post post-carousel">
                            <div class="thumb rounded">
                                <a href="{{ route('frontend.category', $post->category_id) }}"
                                    class="category-badge position-absolute">{{ $post->category->title }}</a>
                                <a href="{{ route('frontend.show', $post->id) }}">
                                    <div class="inner">
                                        <img src="{{ setImage($post->featured_img) }}" alt="{{ $post->slug }}" />
                                    </div>
                                </a>
                            </div>
                            <h5 class="post-title mb-0 mt-4"><a
                                    href="{{ route('frontend.show', $post->id) }}">{{ $post->title }}</a></h5>
                            <ul class="meta list-inline mt-2 mb-0">
                                <li class="list-inline-item">{{ $post->user->name }}</li>
                                <li class="list-inline-item">
                                    {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
                <!-- carousel arrows -->
                <div class="slick-arrows-bot">
                    <button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons"
                        aria-label="Previous"><i class="icon-arrow-left"></i></button>
                    <button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons"
                        aria-label="Next"><i class="icon-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <!-- widget advertisement -->
        <div class="widget no-container rounded text-md-center">
            <span class="ads-title">- Sponsored Ad -</span>
            <a href="/" class="widget-ads">
                <img src="{{ asset('frontend/images/ads/ad-360.png') }}" alt="Advertisement" />
            </a>
        </div>

        <!-- widget tags -->
        <div class="widget rounded">
            <div class="widget-header text-center">
                <h3 class="widget-title">Tag Clouds</h3>
                <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
            </div>
            <div class="widget-content">
                @forelse ($tags as $tag)
                    <a href="{{ route('frontend.tag', $tag) }}" class="tag">{{ "#$tag->slug" }}</a>
                @empty
                    <p class="text-center">No tags to be found</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
