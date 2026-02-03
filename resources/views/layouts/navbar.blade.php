        <!-- Start Navbar Area -->
        <nav class="navbar navbar-expand-xl" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home.index') }}" >
                    <img src="{{ asset('assets/images/logo-original.png') }}" alt="logo" style="width: 125px">
                </a>
                <form class="search-form">
                    <input type="text" class="search-field" placeholder="{{ __('website.nav.search_placeholder') }}">
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
                                {{ __('website.nav.home') }}
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}">
                            <a href="{{ route('properties.leftSidebar') }}" class="nav-link">
                                {{ __('website.nav.properties') }}
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                            <a href="{{ route('blogs.index') }}" class="nav-link">
                                {{ __('website.nav.blog') }}
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                            <a href="{{ route('contact.index') }}" class="nav-link">
                                {{ __('website.nav.contact') }}
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
                                        <a href="{{ route('admin.dashboard', $locale) }}">{{ __('website.nav.my_account') }}</a>
                                    @elseif ($user->role === 'broker')
                                        <a href="{{ route('broker.dashboard', $locale) }}">{{ __('website.nav.my_account') }}</a>
                                    @else
                                        <a href="{{ route('dashboard') }}">{{ __('website.nav.my_account') }}</a>
                                    @endif
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin-left: 12px;">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('website.nav.logout') }}</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">{{ __('website.nav.login_register') }}</a>
                                @endauth
                            </div>
                        </div>
                        <div class="option-item ms-3">
                            @php $currentLocale = app()->getLocale(); @endphp
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-global-line me-1"></i>
                                    <span class="text-uppercase">{{ $currentLocale }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center {{ $currentLocale === 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">
                                            <span>العربية</span>
                                            <span class="badge bg-light text-dark">AR</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center {{ $currentLocale === 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                                            <span>English</span>
                                            <span class="badge bg-light text-dark">EN</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="option-item">
                            <a href="{{ route('contact.index') }}" class="default-btn">{{ __('website.nav.contact_button') }}</a>
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
                            {{ __('website.nav.home') }}
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('properties.*') ? 'active' : '' }}">
                        <a href="{{ route('properties.leftSidebar') }}" class="nav-link">
                            {{ __('website.nav.properties') }}
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                        <a href="{{ route('blogs.index') }}" class="nav-link">
                            {{ __('website.nav.blog') }}
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                        <a href="{{ route('contact.index') }}" class="nav-link">
                            {{ __('website.nav.contact') }}
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
                                    <a href="{{ route('admin.dashboard', $locale) }}">{{ __('website.nav.my_account') }}</a>
                                @elseif ($user->role === 'broker')
                                    <a href="{{ route('broker.dashboard', $locale) }}">{{ __('website.nav.my_account') }}</a>
                                @else
                                    <a href="{{ route('dashboard') }}">{{ __('website.nav.my_account') }}</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin-left: 12px;">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('website.nav.logout') }}</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}">{{ __('website.nav.login_register') }}</a>
                            @endauth
                        </div>
                    </div>
                    <div class="option-item mt-2">
                        <a href="{{ route('contact.index') }}" class="default-btn">{{ __('website.nav.contact_button') }}</a>
                    </div>
                    <div class="option-item mt-3">
                        <form class="search-form">
                            <input type="text" class="search-field" placeholder="{{ __('website.nav.search_placeholder') }}">
                            <button type="submit">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>
                    </div>
                    <div class="option-item mt-3">
                        @php $currentLocale = app()->getLocale(); @endphp
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('language.switch', 'ar') }}" class="badge rounded-pill {{ $currentLocale === 'ar' ? 'bg-primary text-white' : 'bg-light text-dark' }}">العربية</a>
                            <a href="{{ route('language.switch', 'en') }}" class="badge rounded-pill {{ $currentLocale === 'en' ? 'bg-primary text-white' : 'bg-light text-dark' }}">English</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
