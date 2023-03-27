@extends('layouts.frontendapp')

@section('content')
    <section class="main-content mt-3">
        <div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.category', $post->category_id) }}">{{ str()->headline($post->category->title) }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $post->title }}
                    </li>
                </ol>
            </nav>

            <div class="row gy-4">

                <div class="col-lg-8">
                    <!-- post single -->
                    <div class="post post-single" id="{{ $post->id }}">
                        <!-- post header -->
                        <div class="post-header">
                            <h1 class="title mt-0 mb-3">
                                {{ $post->title }}
                            </h1>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="{{ route('frontend.show', $post) }}">
                                        <img src="{{ setImage($post->user->avatar) }}" class="author avatar"
                                            alt="{{ 'author-' . $post->user->name }}" />
                                        {{ $post->user->name }} </a>
                                </li>
                                @if ($post->type)
                                    <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}">
                                            {{ $post->type }}
                                        </a></li>
                                @endif

                                <li class="list-inline-item">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                </li>
                                <li class="list-inline-item btn btn-default btn-sm">Views :
                                    <span class="view-count">{{ $post->view_count }}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- featured image -->
                        <div class="featured-image">
                            <img src="{{ setImage($post->featured_img) }}" alt="post-title" />
                        </div>
                        <!-- post content -->
                        <div class="post-content clearfix">
                            {!! $post->content !!}
                        </div>
                        <!-- post bottom section -->
                        <div class="post-bottom">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 col-12 text-center text-md-start">
                                    <!-- tags -->
                                    @isset($post->tags)
                                        @foreach ($post->tags as $tag)
                                            {{-- print_r(json_decode($tag->name)->name->name->en) --}}
                                            <a href="{{ route('frontend.show', $post) }}"
                                                class="tag">#{{ print_r(json_decode($tag->name)->name->name->en) }}</a>
                                        @endforeach
                                    @endisset

                                </div>
                                <div class="col-md-6 col-12">
                                    <!-- social icons -->
                                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="fab fa-pinterest"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="fab fa-telegram-plane"></i></a></li>
                                        <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                                    class="far fa-envelope"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="spacer" data-height="50"></div>

                    <div class="about-author padding-30 rounded">
                        <div class="thumb">
                            <img src="{{ setImage($post->user->avatar) }}" alt="{{ $post->user->name }}" />
                        </div>
                        <div class="details">
                            <h4 class="name"><a href="{{ route('frontend.show', $post) }}">{{ $post->user->name }}</a>
                            </h4>
                            <p>Hello, I’m a content writer who is fascinated by content fashion, celebrity and
                                lifestyle. She helps clients bring the right content to the right people.</p>
                            <!-- social icons -->
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="blog-single.html#"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="blog-single.html#"><i
                                            class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-medium"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Comments ({{ count($post->comments) }})</h3>
                        <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
                    </div>
                    <!-- post comments -->
                    <div class="comments bordered padding-30 rounded">

                        <ul class="comments" id="commentList">
                            @foreach ($post->comments as $comment)
                                <!-- comment item -->
                                <li class="comment rounded">
                                    <div class="avatar thumb">
                                        <img src="{{ setImage($comment->user->avatar) }}" alt="{{ $comment->user->name }}"
                                            loading="lazy" />
                                    </div>
                                    <div class="details">
                                        <h4 class="name"><a href="blog-single.html#">{{ $comment->user->name }}</a>
                                        </h4>
                                        <span
                                            class="date">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                        <p class="text-dark">{{ $comment->content }}</p>
                                    </div>
                                    <form action="{{ route('reply.store') }}" method="post" class="form-group">
                                        @csrf
                                        <div class="d-flex gap-2 align-items-center mx-5">
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <input type="text" class="form-control" id="reply" name="reply"
                                                placeholder="Reply this comment" required="required">
                                            <button type="submit" class="btn btn-dark btn-sm">Reply</button>
                                        </div>
                                    </form>
                                    <ul class="ms-3">
                                        <h6>
                                            <span class="mb-3 text-default">Replies</sp>
                                        </h6>
                                        @forelse ($comment->replies as $reply)
                                            <li class="comment rounded">
                                                <div class="avatar thumb">
                                                    <img src="{{ setImage($reply->user->avatar) }}"
                                                        alt="{{ $reply->user->name }}" loading="lazy" />
                                                </div>
                                                <div class="details">
                                                    <h4 class="name"><a
                                                            href="blog-single.html#">{{ $reply->user->name }}</a>
                                                    </h4>
                                                    <span
                                                        class="date">{{ Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                                                    <p class="text-dark">{{ $reply->content }}</p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-center">
                                                <span>No replies yet</sp>
                                            </li>
                                        @endforelse
                                    </ul>

                                </li>
                            @endforeach
                            <li>
                                <form action="{{ route('comment.store') }}" method="post" class="form-group">
                                    @csrf
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <input type="text" class="form-control" id="comment" name="comment"
                                            placeholder="Leave a comment" required="required">
                                        <button type="submit" class="btn btn-default btn-sm">Comment</button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>



                    {{-- <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Leave Comment</h3>
                        <img src="images/wave.svg" class="wave" alt="wave" />
                    </div>
                    <!-- comment form -->
                    <div class="comment-form rounded bordered padding-30">

                        <form id="comment-form" class="comment-form" method="post">

                            <div class="messages"></div>

                            <div class="row">

                                <div class="column col-md-12">
                                    <!-- Comment textarea -->
                                    <div class="form-group">
                                        <textarea name="InputComment" id="InputComment" class="form-control" rows="4"
                                            placeholder="Your comment here..." required="required"></textarea>
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <!-- Email input -->
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="InputEmail" name="InputEmail"
                                            placeholder="Email address" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <!-- Name input -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="InputWeb" id="InputWeb"
                                            placeholder="Website" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-12">
                                    <!-- Email input -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="InputName" name="InputName"
                                            placeholder="Your name" required="required">
                                    </div>
                                </div>

                            </div>

                            <button type="submit" name="submit" id="submit" value="Submit"
                                class="btn btn-default">Submit</button><!-- Submit Button -->

                        </form>
                    </div> --}}
                </div>

                @include('layouts.fronendSidebar')

            </div>

        </div>
    </section>
    @push('customJs')
        <script>
            //incrementing the view count based on reading time
            $(document).ready(function() {
                let avg = 0.252 // reading time in word per seconds
                let text = $.trim(jQuery($('.post-content')).text()).split(' ') //splittin text
                let readingTime = Math.round(text.length * (3 / 5) * avg) * 1000 // in ms
                let id = $('.post-single').attr('id');
                console.log(readingTime);
                let url = "{{ route('post.viewCount', ':id') }}"
                url = url.replace(":id", id)
                setTimeout(() => {
                    $.ajax({
                        method: 'GET',
                        url: url,
                        success: function(data) {
                            console.log(data);
                            $('.view-count').text(data.view_count);
                        }
                    })
                }, readingTime)
            });
        </script>
    @endpush
@endsection
