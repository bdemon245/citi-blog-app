<ul>
    <li>
        <a href="{{ route('dashboard') }}"
            class="side-menu {{ request()->routeIs('dashboard') ? 'side-menu--active side-menu--open' : '' }}">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="side-menu__title">
                Dashboard

            </div>
        </a>

    </li>
    <li>
        <a href="{{ route('role.index') }}"
            class="side-menu {{ request()->routeIs('role.*') ? 'side-menu--active side-menu--open' : '' }}">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="side-menu__title">
                Role Management

            </div>
        </a>

    </li>

    <li>
        <a href="{{ route('user.index') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="side-menu__title">
                User Management

            </div>
        </a>

    </li>

    <li>
        <a href="javascript:;"
            class="side-menu  {{ request()->routeIs('category.*') | request()->routeIs('subCategory.*') ? 'side-menu--active side-menu--open' : '' }}">
            <div class="side-menu__icon"> <i data-feather="folder"></i> </div>
            <div class="side-menu__title">
                Category
                <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
            </div>
        </a>
        <ul
            class="{{ request()->routeIs('category.*') | request()->routeIs('subCategory.*') ? 'side-menu__sub-open' : '' }}">
            <li>
                <a href="{{ route('category.index') }}" class="side-menu side-menu--active side-menu--open">
                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="side-menu__title"> Category Manegment </div>
                </a>
            </li>
            <li>
                <a href="{{ route('subCategory.index') }}" class="side-menu side-menu--active side-menu--open">
                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="side-menu__title"> Sub-Category Manegment </div>
                </a>
            </li>

        </ul>
    </li>

    <li>
        <a href="javascript:;"
            class="side-menu  {{ request()->routeIs('post.*') ? 'side-menu--active side-menu--open' : '' }}">
            <div class="side-menu__icon"> <i data-feather="folder"></i> </div>
            <div class="side-menu__title">
                Post
                <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
            </div>
        </a>
        <ul class="{{ request()->routeIs('post.*') ? 'side-menu__sub-open' : '' }}">
            <li>
                <a href="{{ route('post.create') }}" class="side-menu side-menu--active side-menu--open">
                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="side-menu__title"> Add Post</div>
                </a>
            </li>
            <li>
                <a href="{{ route('post.index') }}" class="side-menu side-menu--active side-menu--open">
                    <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="side-menu__title"> View All Posts </div>
                </a>
            </li>

        </ul>
    </li>


</ul>
