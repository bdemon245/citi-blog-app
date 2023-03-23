<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Katen - Minimal Blog & Magazine HTML Theme</title>
    <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- STYLES -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/css/simple-line-icons.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css" media="all">

    {{-- css for scrollbar --}}
    <style>
        #style-3::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar-thumb {
            background-color: #FE4F70;
        }

        .scrollbar {
            margin-left: 30px;
            float: right;
            height: 300px;
            overflow-y: scroll;
            margin: 25px 0;
        }

        .force-overflow {
            min-height: 450px;
        }
    </style>
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        <!-- header -->
        <header class="header-classic">

            <div class="container-xl">
                <!-- header top -->
                <div class="header-top">
                    <div class="row align-items-center">

                        <div class="col-md-4 col-xs-12">
                            <!-- site logo -->
                            <a class="navbar-brand" id="top" href="{{ route('frontend.home') }}">
                                <img src="{{ asset('frontend/images/logo.svg') }}" alt="logo" />
                            </a>
                        </div>

                        <div class="col-md-8 d-none d-md-block">
                            <!-- social icons -->
                            <ul class="social-icons list-unstyled list-inline mb-0 float-end">
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-medium"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg">
                <!-- header bottom -->
                <div class="header-bottom  w-100">

                    <div class="container-xl">
                        <div class="d-flex align-items-center">
                            <div class="collapse navbar-collapse flex-grow-1">
                                <!-- menus -->
                                <ul class="navbar-nav">
                                    <li class="nav-item  active">
                                        <a class="nav-link " href="{{ route('frontend.home') }}">Home</a>

                                    </li>
                                    @foreach ($categories as $category)
                                        <li
                                            class="nav-item {{ count($category->subcategories) > 0 ? 'dropdown' : '' }}">
                                            <a class="nav-link {{ count($category->subcategories) > 0 ? 'dropdown-toggle' : '' }}"
                                                href="{{ route('frontend.category', $category->id) }}">{{ $category->title }}</a>
                                            @if (count($category->subcategories) > 0)
                                                <ul class="dropdown-menu">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('frontend.subcategory', $subcategory) }}">{{ $subcategory->title }}</a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach

                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact</a>

                                    </li>
                                    <li class="nav-item">
                                        @auth
                                            <a class="nav-link" href="{{ route('login') }}">Your Profile</a>
                                        @else
                                            <a class="nav-link" href="{{ route('login') }}">Log In</a>
                                        @endauth

                                    </li>
                                </ul>
                            </div>

                            <!-- header buttons -->
                            <div class="header-buttons">
                                <button class="search icon-button">
                                    <i class="icon-magnifier"></i>
                                </button>
                                <button class="burger-menu icon-button ms-2 float-end float-lg-none">
                                    <span class="burger-icon"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>

        </header>

        @yield('content')

        @yield('sidebar')
        <!-- footer -->
        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <!-- copyright text -->
                        <div class="col-md-4">
                            <span class="copyright">© 2021 Katen. Template by ThemeGer.</span>
                        </div>

                        <!-- social icons -->
                        <div class="col-md-4 text-center">
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-medium"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="classic.html#"><i
                                            class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>

                        <!-- go to top button -->
                        <div class="col-md-4">
                            <a href="#top" id="return-to-top" class="float-md-end"><i
                                    class="icon-arrow-up"></i>Back to
                                Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input name="search_text" id="searchInput" class="form-control me-2" type="search"
                    placeholder="Search and press enter ..." aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>

            <div class="scrollbar" id="style-3">
                <ul class="force-overflow" style="list-style: none;margin-top: 20px;" id="searchResultShow">

                </ul>
            </div>




        </div>
    </div>

    <!-- canvas menu -->
    <div class="canvas-menu d-flex align-items-end flex-column">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>

        <!-- logo -->
        <div class="logo">
            <a href="{{ route('frontend.home') }}">
                <img src="{{ asset('frontend/images/logo.svg') }}" alt="Katen" />
            </a>
        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu">
                <li class="active">
                    <a class="" href="{{ route('frontend.home') }}">Home</a>
                </li>
                @foreach ($categories as $category)
                    <li class="{{ request()->routeIs('frontend.category', $category->id) ? 'active' : '' }}">
                        <a href="{{ route('frontend.category', $category->id) }}">{{ $category->title }}</a>
                        <ul class="submenu">
                            @foreach ($category->subCategories as $sub)
                                <li><a href="{{ route('frontend.subcategory', $sub->id) }}">{{ $sub->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <li><a href="contact.html">Contact</a></li>
                <li><a href="contact.html">Log Out</a></li>
            </ul>

        </nav>

        <!-- social icons -->
        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-pinterest"></i></a></li>
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-medium"></i></a></li>
            <li class="list-inline-item"><a href="classic.html#"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>

    <!-- JAVA SCRIPTS -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <script>
        $('#searchInput').on('keyup', function() {

            let value = $(this).val()
            if (value.length > 3) {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('frontend.search.live') }}",
                    data: {
                        search: value
                    },
                    success: function(data) {

                        let results = JSON.parse(data)
                        let posts = []
                        results.forEach(result => {

                            let url = `{{ route('frontend.show', ':post') }}`;
                            url = url.replace(':post', result.id)
                            let src = ~result.featured_img.indexOf("uploads/") ?
                                `storage/${result.featured_img})` : result.featured_img
                            let li = `
                                        <li class="border-bottom py-3">
                                        <a href="${url}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-3">
                                                    <img src="${src}"  alt="">
                                                </div>
                                                <div class="col-lg-9">
                                                    <h6>${result.title}</h6>
                                                </div>
                                            </div>
                                        </a>
                                        </li>
                                        `;

                            posts.push(li)

                        });


                        $('#searchResultShow').html(posts)




                    },
                    error: function(error) {

                        $('#searchResultShow').html(`<h5>${error.responseText}</h5>`)
                    }





                });
            } else {
                $('#searchResultShow').html('')
            }


        })
    </script>
    @stack('customJs')

</body>

</html>
