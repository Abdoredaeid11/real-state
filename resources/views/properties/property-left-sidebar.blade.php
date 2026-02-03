@extends('layouts.master')
@section('content')

        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
            <div class="container">
                <div class="page-banner-content">
                    <h2>{{ __('website.properties.left_sidebar_title') }}</h2>
                    <ul class="list">
                        <li>
                            <a href="{{ route('home.index') }}">{{ __('website.properties.breadcrumb_home') }}</a>
                        </li>
                        <li>{{ __('website.properties.breadcrumb_current') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner Area -->

        <!-- Start Properties Area -->
        <div class="properties-area ptb-120">
            <div class="container">
                <div class="row justify-content-center" data-cues="slideInUp">
                    <div class="col-xl-4 col-md-12">
                        <div class="properties-widget-area wrap-left">
                            <div class="widget widget_search">
                                <form class="search-form" action="{{ route('properties.leftSidebar') }}" method="GET">
                                    <input type="text" name="search" class="search-field" placeholder="{{ __('website.properties.search_placeholder') }}" value="{{ request('search') }}">
                                    <button type="submit"><i class="ri-search-line"></i></button>
                                </form>
                            </div>
                            <div class="widget widget_categories">
                                <h3 class="widget-title">{{ __('website.properties.type_title') }}</h3>
                                <ul class="list">
                                    @foreach($propertyTypes as $type)
                                    <li>
                                        <a href="{{ route('properties.leftSidebar', array_merge(request()->query(), ['property_type' => $type->id])) }}">{{ $type->name }}</a>
                                        <span>{{ $type->properties->count() }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget_property_status">
                                <h3 class="widget-title">{{ __('website.properties.status_title') }}</h3>
                                <ul class="list">
                                    <li>
                                        <a href="{{ route('properties.leftSidebar', array_merge(request()->query(), ['status' => 'rent'])) }}" class="{{ request('status') == 'rent' ? 'active' : '' }}">
                                            {{ __('website.properties.for_rent') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('properties.leftSidebar', array_merge(request()->query(), ['status' => 'sale'])) }}" class="{{ request('status') == 'sale' ? 'active' : '' }}">
                                            {{ __('website.properties.for_sale') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget widget_price_range">
                                <h3 class="widget-title">{{ __('website.properties.price_range') }}</h3>
                                <div class="range-slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" id="price-min" min="0" max="1000000" value="{{ request('min_price', 2500) }}" step="100">
                                    <input type="range" class="range-max" id="price-max" min="0" max="1000000" value="{{ request('max_price', 7500) }}" step="100">
                                </div>
                                <div class="price-input">
                                    <div class="field">
                                        <input type="text" class="input-min" id="price-min-text" value="{{ request('min_price', 2500) }}">
                                    </div>
                                    <div class="field">
                                        <input type="text" class="input-max" id="price-max-text" value="{{ request('max_price', 7500) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget_home_area_range">
                                <h3 class="widget-title">{{ __('website.properties.home_area') }}</h3>
                                <div class="home-range-slider">
                                    <div class="home-progress"></div>
                                </div>
                                <div class="home-range-input">
                                    <input type="range" class="range-min" id="area-min" min="0" max="10000" value="{{ request('min_area', 2500) }}" step="100">
                                    <input type="range" class="range-max" id="area-max" min="0" max="10000" value="{{ request('max_area', 7500) }}" step="100">
                                </div>
                                <div class="home-price-input">
                                    <div class="field">
                                        <input type="text" class="input-min" id="area-min-text" value="{{ request('min_area', 2500) }}">
                                    </div>
                                    <div class="field">
                                        <input type="text" class="input-max" id="area-max-text" value="{{ request('max_area', 7500) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget_advanced_search">
                                <h3 class="widget-title">{{ __('website.properties.advanced_search') }}</h3>
                                <form class="advanced-search-form" action="{{ route('properties.leftSidebar') }}" method="GET">

                                    <div class="form-group">
                                        <input type="number" name="min_price" class="form-control" placeholder="{{ __('website.properties.min_price') }}" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="max_price" class="form-control" placeholder="{{ __('website.properties.max_price') }}" value="{{ request('max_price') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="min_area" class="form-control" placeholder="{{ __('website.properties.min_area') }}" value="{{ request('min_area') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="max_area" class="form-control" placeholder="{{ __('website.properties.max_area') }}" value="{{ request('max_area') }}">
                                    </div>
                                    <div class="form-group">
                                        <select name="bedrooms" class="form-select form-control">
                                            <option value="">{{ __('website.properties.bedroom') }}</option>
                                            <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ request('bedrooms') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ request('bedrooms') == '6' ? 'selected' : '' }}>6</option>
                                            <option value="10" {{ request('bedrooms') == '10' ? 'selected' : '' }}>10</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="bathrooms" class="form-select form-control">
                                            <option value="">{{ __('website.properties.bathroom') }}</option>
                                            <option value="2" {{ request('bathrooms') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ request('bathrooms') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ request('bathrooms') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ request('bathrooms') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="7" {{ request('bathrooms') == '7' ? 'selected' : '' }}>7</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="city" class="form-select form-control">
                                            <option value="">{{ __('website.properties.all_city') }}</option>
                                            <option value="Cairo" {{ request('city') == 'Cairo' ? 'selected' : '' }}>Cairo</option>
                                            <option value="Giza" {{ request('city') == 'Giza' ? 'selected' : '' }}>Giza</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="default-btn">
                                            {{ __('website.properties.search_button') }}
                                        </button>
                                    </div>
                                    <button type="submit" class="reset-search-btn">
                                        <i class="ri-refresh-line"></i>
                                        {{ __('website.properties.reset_button') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-12">
                        <div class="properties-grid-box">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-7 col-md-6">
                                    <p>{{ __('website.properties.showing_results', ['from' => $properties->firstItem(), 'to' => $properties->lastItem(), 'total' => $properties->total()]) }}</p>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        @auth
                                            @if(auth()->user()->role === \App\Models\User::ROLE_USER)
                                                <a href="{{ route('user.properties.create') }}" class="default-btn">
                                                    {{ app()->getLocale() == 'ar' ? 'أضف وحدة' : 'Add Property' }}
                                                </a>
                                            @endif
                                        @endauth
                                        <select class="form-select" onchange="location = this.value;">
                                            <option value="{{ route('properties.leftSidebar', array_merge(request()->query(), ['sort' => 'recommend'])) }}" {{ request('sort') == 'recommend' ? 'selected' : '' }}>{{ __('website.properties.sort_recommend') }}</option>
                                            <option value="{{ route('properties.leftSidebar', array_merge(request()->query(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('website.properties.sort_newest') }}</option>
                                            <option value="{{ route('properties.leftSidebar', array_merge(request()->query(), ['sort' => 'latest'])) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('website.properties.sort_latest') }}</option>
                                            <option value="{{ route('properties.leftSidebar', array_merge(request()->query(), ['sort' => 'popularity'])) }}" {{ request('sort') == 'popularity' ? 'selected' : '' }}>{{ __('website.properties.sort_popularity') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            @foreach($properties as $property)
                            <div class="col-xl-6 col-md-6">
                                <div class="properties-item">
                                    <div class="properties-image">
                                        <a href="{{ route('property.show', $property->id) }}">
                                            <img src="{{ $property->images->first() ? asset('storage/' . $property->images->first()->image) : asset('assets/images/properties/properties1.jpg') }}" style="height: 260px" alt="image">
                                        </a>
                                        <ul class="action">
                                            <li>
                                                <a href="#" class="featured-btn">{{ __('website.properties.featured') }}</a>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <span><i class="ri-vidicon-fill"></i></span>
                                                    <span><i class="ri-image-line"></i>{{ $property->images->count() }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="link-list">
                                            <li>
                                                <a href="#" class="link-btn">{{ $property->type->name ?? __('website.properties.property_label') }}</a>
                                            </li>
                                            <li>
                                                <a href="#" class="link-btn">
                                                    @if($property->status === 'rent')
                                                        {{ __('website.properties.for_rent') }}
                                                    @elseif($property->status === 'sale')
                                                        {{ __('website.properties.for_sale') }}
                                                    @else
                                                        {{ ucfirst($property->status) }}
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="info-list">
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/properties/bed.svg') }}" alt="bed">
                                                </div>
                                                <span>{{ $property->bedrooms }}</span>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/properties/bathroom.svg') }}" alt="bathroom">
                                                </div>
                                                <span>{{ $property->bathrooms }}</span>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/properties/area.svg') }}" alt="area">
                                                </div>
                                                <span>{{ $property->area }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="properties-content">
                                        <div class="top">
                                            <div class="title">
                                                <h3>
                                                    <a href="{{ route('property.show', $property->id) }}">{{ $property->title }}</a>
                                                </h3>
                                                <span>{{ $property->address }}</span>
                                            </div>
                                            <div class="price">${{ number_format($property->price) }}</div>
                                        </div>
                                        <div class="bottom">
                                            <div class="user">
                                                <img src="{{ $property->broker?->profile_photo ?? asset('assets/images/user/user1.png') }}" alt="image">
                                                <a href="#">{{ $property->broker?->name ?? __('website.property.no_broker') }}</a>
                                            </div>
                                            <ul class="group-info">
                                                <li>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-share-line"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="https://www.facebook.com/" target="_blank">
                                                                    <i class="ri-facebook-fill"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="https://twitter.com/" target="_blank">
                                                                    <i class="ri-twitter-x-line"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="https://www.instagram.com/" target="_blank">
                                                                    <i class="ri-instagram-fill"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="https://bd.linkedin.com/" target="_blank">
                                                                    <i class="ri-linkedin-fill"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                            </li>
                                          <li>
    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('website.general.call') }}">
        <i class="ri-phone-line"></i>
    </button>
</li>
<li>
    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('website.general.whatsapp') }}">
        <i class="ri-whatsapp-line"></i>
    </button>
</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-lg-12 col-md-12">
                                <div class="pagination-area">
                                    {{ $properties->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Properties Area -->

        <!-- Start Properties Slide Area -->
        <div class="properties-slide-area pt-120 pb-120">
            <div class="container-fluid">
                <div class="section-title text-center" data-cues="slideInUp">
                    <h2>Popular Properties</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris eget ornare venenatis, in. Pharetra iaculis consectetur.</p>
                </div>
                <div class="swiper properties-slider">
                    <div class="swiper-wrapper align-items-center" data-cues="slideInUp">
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="{{ asset('assets/images/properties/properties11.jpg') }}" alt="image">
                                    </a>
                                    <a href="property-grid.html" class="featured-btn">Featured</a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Vacation Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$95,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/properties/bed.svg') }}" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/properties/bathroom.svg') }}" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/properties/parking.svg') }}" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/properties/area.svg') }}" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                            <a href="agent-profile.html">Thomas Klarck</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties12.jpg" alt="image">
                                    </a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Newly Built Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$56,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user2.png" alt="image">
                                            <a href="agent-profile.html">Walter White</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties13.jpg" alt="image">
                                    </a>
                                    <a href="property-grid.html" class="featured-btn">Featured</a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Single-Family Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$67,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user3.png" alt="image">
                                            <a href="agent-profile.html">Jane Ronan</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties14.jpg" alt="image">
                                    </a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Luxury Apartments</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$88,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user4.png" alt="image">
                                            <a href="agent-profile.html">Jack Smith</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties11.jpg" alt="image">
                                    </a>
                                    <a href="property-grid.html" class="featured-btn">Featured</a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Vacation Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$95,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user1.png" alt="image">
                                            <a href="agent-profile.html">Thomas Klarck</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties12.jpg" alt="image">
                                    </a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Newly Built Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$56,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user2.png" alt="image">
                                            <a href="agent-profile.html">Walter White</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties13.jpg" alt="image">
                                    </a>
                                    <a href="property-grid.html" class="featured-btn">Featured</a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Single-Family Homes</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$67,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user3.png" alt="image">
                                            <a href="agent-profile.html">Jane Ronan</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="properties-slide-item">
                                <div class="properties-image">
                                    <a href="property-details.html">
                                        <img src="assets/images/properties/properties14.jpg" alt="image">
                                    </a>
                                    <div class="media">
                                        <span><i class="ri-vidicon-fill"></i></span>
                                        <span><i class="ri-image-line"></i>5</span>
                                    </div>
                                    <ul class="link-list">
                                        <li>
                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                        </li>
                                        <li>
                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="properties-content">
                                    <div class="top">
                                        <div class="title">
                                            <h3>
                                                <a href="property-details.html">Luxury Apartments</a>
                                            </h3>
                                            <span>194 Mercer Street, NY 10012, USA</span>
                                        </div>
                                        <div class="price">$88,000</div>
                                    </div>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bed.svg" alt="bed">
                                            </div>
                                            <span>6</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/bathroom.svg" alt="bathroom">
                                            </div>
                                            <span>4</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/parking.svg" alt="parking">
                                            </div>
                                            <span>1</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="assets/images/properties/area.svg" alt="area">
                                            </div>
                                            <span>3250</span>
                                        </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="user">
                                            <img src="assets/images/user/user4.png" alt="image">
                                            <a href="agent-profile.html">Jack Smith</a>
                                        </div>
                                        <ul class="group-info">
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-share-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="https://www.facebook.com/" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://twitter.com/" target="_blank">
                                                                <i class="ri-twitter-x-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://www.instagram.com/" target="_blank">
                                                                <i class="ri-instagram-fill"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="https://bd.linkedin.com/" target="_blank">
                                                                <i class="ri-linkedin-fill"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add To Favorites">
                                                    <i class="ri-heart-line"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <i class="ri-arrow-left-right-line"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="properties-pagination"></div>
                </div>
            </div>
        </div>
        <!-- End Properties Slide Area -->

        <!-- Start Subscribe Area -->
        <div class="subscribe-wrap-area">
            <div class="container" data-cues="slideInUp">
                <div class="subscribe-wrap-inner-area">
                    <div class="subscribe-content">
                        <h2>Subscribe To Our Newsletter</h2>
                        <form class="subscribe-form">
                            <input type="search" class="form-control" placeholder="Enter your email">
                            <button type="submit" class="default-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Subscribe Area -->

        <script>
            // Sync price range
            const priceMin = document.getElementById('price-min');
            const priceMax = document.getElementById('price-max');
            const priceMinText = document.getElementById('price-min-text');
            const priceMaxText = document.getElementById('price-max-text');
            const priceProgress = document.querySelector('.range-slider .progress');

            function syncPrice() {
                priceMinText.value = priceMin.value;
                priceMaxText.value = priceMax.value;
                updatePriceProgress();
            }

            priceMin.addEventListener('input', () => {
                syncPrice();
                if (parseInt(priceMin.value) > parseInt(priceMax.value)) {
                    priceMax.value = priceMin.value;
                    priceMaxText.value = priceMax.value;
                }
                redirectWithParams();
            });
            priceMax.addEventListener('input', () => {
                syncPrice();
                if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
                    priceMin.value = priceMax.value;
                    priceMinText.value = priceMin.value;
                }
                redirectWithParams();
            });
            priceMinText.addEventListener('input', () => {
                priceMin.value = priceMinText.value;
                updatePriceProgress();
                if (parseInt(priceMin.value) > parseInt(priceMax.value)) {
                    priceMax.value = priceMin.value;
                    priceMaxText.value = priceMax.value;
                    updatePriceProgress();
                }
                redirectWithParams();
            });
            priceMaxText.addEventListener('input', () => {
                priceMax.value = priceMaxText.value;
                updatePriceProgress();
                if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
                    priceMin.value = priceMax.value;
                    priceMinText.value = priceMin.value;
                    updatePriceProgress();
                }
                redirectWithParams();
            });

            // Sync area range
            const areaMin = document.getElementById('area-min');
            const areaMax = document.getElementById('area-max');
            const areaMinText = document.getElementById('area-min-text');
            const areaMaxText = document.getElementById('area-max-text');
            const areaProgress = document.querySelector('.home-range-slider .home-progress');

            function syncArea() {
                areaMinText.value = areaMin.value;
                areaMaxText.value = areaMax.value;
                updateAreaProgress();
            }

            function updatePriceProgress() {
                const min = parseInt(priceMin.value);
                const max = parseInt(priceMax.value);
                const left = (min / 1000000) * 100;
                const width = ((max - min) / 1000000) * 100;
                priceProgress.style.left = left + '%';
                priceProgress.style.width = width + '%';
            }

            function updateAreaProgress() {
                const min = parseInt(areaMin.value);
                const max = parseInt(areaMax.value);
                const left = (min / 10000) * 100;
                const width = ((max - min) / 10000) * 100;
                areaProgress.style.left = left + '%';
                areaProgress.style.width = width + '%';
            }

            // Initial update
            updatePriceProgress();
            updateAreaProgress();

            areaMin.addEventListener('input', () => {
                syncArea();
                if (parseInt(areaMin.value) > parseInt(areaMax.value)) {
                    areaMax.value = areaMin.value;
                    areaMaxText.value = areaMax.value;
                }
                redirectWithParams();
            });
            areaMax.addEventListener('input', () => {
                syncArea();
                if (parseInt(areaMax.value) < parseInt(areaMin.value)) {
                    areaMin.value = areaMax.value;
                    areaMinText.value = areaMin.value;
                }
                redirectWithParams();
            });
            areaMinText.addEventListener('input', () => {
                areaMin.value = areaMinText.value;
                updateAreaProgress();
                if (parseInt(areaMin.value) > parseInt(areaMax.value)) {
                    areaMax.value = areaMin.value;
                    areaMaxText.value = areaMax.value;
                    updateAreaProgress();
                }
                redirectWithParams();
            });
            areaMaxText.addEventListener('input', () => {
                areaMax.value = areaMaxText.value;
                updateAreaProgress();
                if (parseInt(areaMax.value) < parseInt(areaMin.value)) {
                    areaMin.value = areaMax.value;
                    areaMinText.value = areaMin.value;
                    updateAreaProgress();
                }
                redirectWithParams();
            });

            // Redirect on change
            let timeout;
            function redirectWithParams() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    const params = new URLSearchParams(window.location.search);
                    params.set('min_price', priceMin.value);
                    params.set('max_price', priceMax.value);
                    params.set('min_area', areaMin.value);
                    params.set('max_area', areaMax.value);
                    window.location.href = '{{ route("properties.leftSidebar") }}?' + params.toString();
                }, 500);
            }

            priceMin.addEventListener('input', redirectWithParams);
            priceMax.addEventListener('input', redirectWithParams);
            areaMin.addEventListener('input', redirectWithParams);
            areaMax.addEventListener('input', redirectWithParams);
        </script>

        @endsection
