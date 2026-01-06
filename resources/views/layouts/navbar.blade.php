        <!-- Start Navbar Area -->
        <nav class="navbar navbar-expand-xl" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home.index') }}" >
                    <img src="{{ asset('assets/images/logo-original.png') }}" alt="logo" style="width: 125px">
                </a>
                <form class="search-form">
                    <input type="text" class="search-field" placeholder="Search property">
                    <button type="submit">
                        <i class="ri-search-line"></i>
                    </button>
                </form>
                <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas">
                    <span class="burger-menu">
                        <span class="top-bar"></span>
                        <span class="middle-bar"></span>
                        <span class="bottom-bar"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse">
                  <ul class="navbar-nav ms-auto">
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ url('/') }}" class="nav-link">
            Home
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}">
        <a href="{{ route('properties.leftSidebar') }}" class="nav-link">
            Property
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
        <a href="{{ route('blogs.index') }}" class="nav-link">
            Blog
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
        <a href="{{ route('contact.index') }}" class="nav-link">
            Contact Us
        </a>
    </li>
</ul>

                    <div class="others-option d-flex align-items-center">
                        <div class="option-item">
                            <div class="user-info">
                                @auth
         @php
                                        $user = auth()->user();
                                        $locale = app()->getLocale();
                                    @endphp
                                    @if ($user->role === 'admin')
                                        <a href="{{ route('admin.dashboard', $locale) }}">My Account</a>
                                    @elseif ($user->role === 'broker')
                                        <a href="{{ route('broker.dashboard', $locale) }}">My Account</a>
                                    @else
                                        <a href="{{ route('dashboard') }}">My Account</a>
                                    @endif                                    <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin-left: 12px;">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Logout</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">Log In / Register</a>
                                @endauth
                            </div>
                        </div>
                        <div class="option-item">
                            <a href="{{ route('contact.index') }}" class="default-btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar Area -->

        <!-- Start Responsive Navbar Area -->
        <div class="responsive-navbar offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas">
            <div class="offcanvas-header">
                <a href="index.html" class="logo d-inline-block">
                    <img src="{{ asset('assets/images/aqarx2.png') }}" alt="logo" style="width: 125px">
                </a>
                <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" class="close-btn">
                    <i class="ri-close-line"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ url('/') }}" class="nav-link">
                            Home
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}">
                        <a href="{{ route('properties.leftSidebar') }}" class="nav-link">
                            Property
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                        <a href="{{ route('blogs.index') }}" class="nav-link">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                        <a href="{{ route('contact.index') }}" class="nav-link">
                            Contact Us
                        </a>
                    </li>
                </ul>
                <div class="others-option mt-3">
                    <div class="option-item">
                        <div class="user-info">
                            @auth
                                @php
                                    $user = auth()->user();
                                    $locale = app()->getLocale();
                                @endphp
                                @if ($user->role === 'admin')
                                    <a href="{{ route('admin.dashboard', $locale) }}">My Account</a>
                                @elseif ($user->role === 'broker')
                                    <a href="{{ route('broker.dashboard', $locale) }}">My Account</a>
                                @else
                                    <a href="{{ route('dashboard') }}">My Account</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin-left: 12px;">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}">Log In / Register</a>
                            @endauth
                        </div>
                    </div>
                    <div class="option-item mt-2">
                        <a href="{{ route('contact.index') }}" class="default-btn">Contact Us</a>
                    </div>
                    <div class="option-item mt-3">
                        <form class="search-form">
                            <input type="text" class="search-field" placeholder="Search property">
                            <button type="submit">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
