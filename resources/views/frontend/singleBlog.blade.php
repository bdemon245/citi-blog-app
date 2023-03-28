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
                            <img src="{{ setImage($post->featured_img) }}" alt="{{ $post->slug }}" />
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
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i
                                            class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i class="fab fa-medium"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="{{ route('frontend.show', $post) }}"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header d-flex gap-3 align-items-center">
                        <div>
                            <h3 class="section-title">Comments
                                ({{ count($post->comments) + countReplies($post->comments) }})</h3>
                        </div>
                        <div>
                            <i id="comment-toggler" style="font-weight:bolder; color:var(--bs-pink);"
                                class="icon-arrow-down"></i>
                        </div>
                    </div>
                    <!-- post comments -->
                    <div class="comments bordered padding-30 rounded" id="comment-container">

                        <ul class="comments" id="commentList">
                            @foreach ($post->comments as $comment)
                                <!-- comment item -->
                                <li class="comment rounded">
                                    <div class="avatar thumb">
                                        <img src="{{ setImage($comment->user->avatar) }}" alt="{{ $comment->user->name }}"
                                            loading="lazy" />
                                    </div>
                                    <div class="details">
                                        <div class="d-flex gap-5 align-items-center">
                                            <strong class="name">{{ $comment->user->name }}
                                            </strong>
                                            <div class="d-flex gap-4">
                                                @auth
                                                    @if ($comment->user_id === auth()->id())
                                                        <button data-url="{{ route('comment.show', $comment) }}"
                                                            id="{{ $comment->id }}"
                                                            class="p-0 m-0 comment-update-btn-{{ $comment->id }}"
                                                            style="border:none; background:none;color: var(--bs-dark); font-weight: bolder;">
                                                            <i class="icon-note"></i>Edit
                                                        </button>
                                                        <form action="{{ route('comment.destroy', $comment) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="p-0 m-0"
                                                                style="border:none; background:none;color: var(--bs-danger); font-weight: bolder;">
                                                                <i class="icon-trash"></i>Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <span class="text-warning">Please login to perform actions</span>
                                                @endauth
                                            </div>
                                        </div>
                                        <span class="date">
                                            {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                        </span>
                                        <div class="mb-3">
                                            <strong
                                                class="text-dark comment-content-{{ $comment->id }}">{{ $comment->content }}</strong>
                                            <img class="comment-ajax-loader-{{ $comment->id }}"
                                                src="{{ asset('frontend/images/ajax-loader.gif') }}" />
                                            <form action="{{ route('reply.update', $comment) }}" method="post"
                                                class="form-group comment-update-form-{{ $comment->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="d-flex gap-2 align-items-center">
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <input type="text"
                                                        class="form-control comment-update-input-{{ $comment->id }}"
                                                        id="reply" name="reply" placeholder="update this comment"
                                                        required="required">
                                                    <button type="submit" class="btn btn-default btn-sm">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>



                                    <form id="{{ $comment->id }}" action="{{ route('reply.store') }}" method="post"
                                        class="form-group reply-store-form-{{ $comment->id }}">
                                        @csrf
                                        <div class="d-flex gap-2 align-items-center mx-5">
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <input type="text" class="form-control" id="reply" name="reply"
                                                placeholder="Reply this comment" required="required">
                                            <button type="submit" class="btn btn-dark btn-sm">Reply</button>
                                        </div>
                                    </form>


                                    <button style="background: none; border:none; margin:0; padding:0;"
                                        class="reply-toggler-{{ $comment->id }}" id="{{ $comment->id }}">
                                        <p class="text-dark">Replies<span class="icon-arrow-down ms-2"
                                                style="font-weight:bold; color:var(--bs-pink);"
                                                id="reply-arrow-{{ $comment->id }}"></span></p>

                                    </button>
                                    <ul class="ms-3 reply-container-{{ $comment->id }}">
                                        @forelse ($comment->replies as $reply)
                                            <li class="comment rounded">
                                                <div class="avatar thumb">
                                                    <img src="{{ setImage($reply->user->avatar) }}"
                                                        alt="{{ $reply->user->name }}" loading="lazy" />
                                                </div>
                                                <div class="details">
                                                    <h4 class="name"><a
                                                            href="{{ route('frontend.show', $post) }}">{{ $reply->user->name }}</a>
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
                }, readingTime);

                //hide all replies initially
                $('[class*="reply-container-"]').hide();



                //expand upon each reply toggler click
                $('[class*="reply-toggler-"]').each(function(i) {
                    $(this).click(function() {
                        $(`#reply-arrow-${this.id}`).toggleClass('icon-arrow-up');
                        $(`.reply-container-${this.id}`).slideToggle();
                    })
                });

                //hide update comment form initially
                $('[class*="comment-update-form-"]').hide();
                $('[class*="comment-ajax-loader-"]').hide();
                //expand upon each comment edit btn click
                $('[class*="comment-update-btn-"]').each(function(i) {
                    // let comment = null;
                    $(this).click(function() {
                        let id = this.id
                        $(`.comment-content-${id}`).hide();
                        $(`.comment-ajax-loader-${id}`).show();
                        $.ajax({
                            type: "get",
                            url: this.dataset.url,
                            success: function(response) {
                                $(`.comment-ajax-loader-${id}`).hide();
                                $(`.comment-update-form-${id}`).slideToggle();
                                $(`.comment-update-input-${id}`).trigger('focus').val(
                                    response.content);
                            }
                        });

                    })
                });


                //hide all comments
                $('#comment-container').hide();

                $('#comment-toggler').click(function(e) {
                    e.preventDefault();
                    $(this).toggleClass('icon-arrow-up');
                    $('#comment-container').slideToggle();
                });

            });
        </script>
    @endpush
@endsection
