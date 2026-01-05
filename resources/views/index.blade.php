@extends('layouts.master')
@section('content')
    <!-- End Responsive Navbar Area -->
       
    <!-- Start Main Banner Area -->
    <div class="main-banner-area">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-md-12" data-cues="slideInLeft">
                    <div class="main-banner-content">
                        <span class="sub">Your Pathway to Home Sweet Home.</span>
                        <h1>More than Property, We Offer Possibilities</h1>
                        <div class="search-info-tabs">
                            <ul class="nav nav-tabs" id="search_tab" role="tablist">
                                @foreach ($tabs as $tabKey => $label)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($loop->first) active @endif"
                                            id="{{ $tabKey }}-tab" data-bs-toggle="tab" href="#{{ $tabKey }}"
                                            role="tab" aria-controls="{{ $tabKey }}">
                                            {{ $label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="search_tab_content">
                                @foreach ($tabs as $tabKey => $label)
                                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                                        id="{{ $tabKey }}" role="tabpanel">
                                        <form class="search-form" action="{{ route('home.search') }}" method="POST">
                                            @csrf

                                            <!-- Hidden input to send tab key -->
                                            <input type="hidden" name="tab" value="{{ $tabKey }}">

                                            <div class="row justify-content-center align-items-end">
                                                <!-- Property Type -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Looking For</label>
                                                        <select class="form-select form-control" name="property_type">
                                                            <option selected>Property type</option>
                                                            @foreach ($propertyTypes as $type)
                                                                <option value="{{ $type->id }}">
                                                                    {{ app()->getLocale() == 'ar' ? $type->name_ar : $type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Location -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Location</label>
                                                        <select class="form-select form-control" name="location">
                                                            <option selected>All cities</option>
                                                            @foreach ($locations as $loc)
                                                                <option value="{{ $loc['name_en'] }}">
                                                                    {{ app()->getLocale() == 'ar' ? $loc['name_ar'] : $loc['name_en'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Price -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Your Max Price</label>
                                                        <input type="text" name="price_max" class="form-control"
                                                            placeholder="Max price">
                                                    </div>
                                                </div>

                                                <!-- Lot Size -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Your Min Price</label>
                                                        <input type="text" name="price_min" class="form-control"
                                                            placeholder="Min price">
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-select form-control" name="status">
                                                            <option selected>Property status</option>
                                                            @foreach ($statuses as $statusKey => $status)
                                                                <option value="{{ $statusKey }}">
                                                                    {{ app()->getLocale() == 'ar' ? $status['ar'] : $status['en'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" class="default-btn">
                                                            <i class="ri-search-2-line"></i> Search Property
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-xl-6 col-md-12" data-cues="fadeIn">
                    <div class="swiper main-banner-image-slider">
                        <div class="swiper-wrapper">
                            @foreach ($banners as $banner)
                                <div class="swiper-slide">
                                    <div class="main-banner-image">
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="image" style="height:590px">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="main-banner-image-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Banner Area -->

    <!-- Start Category Area -->
    <div class="category-area pt-120 pb-95">
        <div class="container">
            <div class="row justify-content-center" data-cues="slideInUp">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-sm-6">
                        <div class="category-card">
                            <div class="image">
                                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/images/category/category1.png') }}"
                                    alt="{{ $category->name }}" style="height: 50px; object-fit: contain;">
                            </div>
                            <div class="content">
                                <h3>
                                    <a
                                        href="{{ route('category.properties', $category->id) }}">{{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}</a>
                                </h3>
                                <span>({{ $category->properties_count }} {{ __('admin.general.properties') }})</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Category Area -->

    <!-- Start Properties Area -->
    <div class="properties-area pb-95">
        <div class="container">
            <div class="section-title text-center" data-cues="slideInUp">
                <h2>Latest Properties</h2>
                
            </div>
            <div class="properties-information-tabs">

                <div class="tab-content" id="properties_tab_content">
                    <div class="tab-pane fade show active" id="latest" role="tabpanel">

                        <div class="row justify-content-center" data-cues="slideInUp">
                            @foreach ($latestProperties as $property)
                                <div class="col-xl-4 col-md-6">
                                    <div class="properties-item">
                                        <div class="properties-image">
                                            <a href="#">
                                                <img src="{{ $property->images->first() ? asset('storage/' . $property->images->first()->image) : asset('assets/images/properties/properties1.jpg') }}"
                                                    alt="image" style="height: 250px; width: 100%; object-fit: cover;">
                                            </a>
                                            <ul class="action">
                                                <li>
                                                    <a href="#" class="featured-btn">Featured</a>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <span><i class="ri-vidicon-fill"></i></span>
                                                        <span><i
                                                                class="ri-image-line"></i>{{ $property->images->count() }}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="link-list">
                                                <li>
                                                    <a href="#"
                                                        class="link-btn">{{ app()->getLocale() == 'ar' ? $property->type : $property->type }}</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="link-btn">{{ ucfirst($property->status) }}</a>
                                                </li>
                                            </ul>
                                            <ul class="info-list">
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/properties/bed.svg') }}"
                                                            alt="bed">
                                                    </div>
                                                    <span>{{ $property->bedrooms }}</span>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/properties/bathroom.svg') }}"
                                                            alt="bathroom">
                                                    </div>
                                                    <span>{{ $property->bathrooms }}</span>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/properties/area.svg') }}"
                                                            alt="area">
                                                    </div>
                                                    <span>{{ $property->area }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="properties-content">
                                            <div class="top">
                                                <div class="title">
                                                    <h3>
                                                        <a
                                                            href="{{route('property.show',$property->id)}}">{{ app()->getLocale() == 'ar' ? $property->title_ar : $property->title }}</a>
                                                    </h3>
                                                    <span>{{ app()->getLocale() == 'ar' ? $property->address_ar : $property->address }}</span>
                                                </div>
                                                <div class="price">${{ number_format($property->price) }}</div>
                                            </div>
                                            <div class="bottom">
                                                <div class="user">
                                                    <img src="{{ $property->broker && $property->broker->image ? asset('storage/' . $property->broker->image) : asset('assets/images/user/user1.png') }}"
                                                        alt="image"
                                                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                                    <a
                                                        href="#">{{ $property->broker ? $property->broker->name : 'Admin' }}</a>
                                                </div>
                                                <ul class="group-info">
                                                    <li>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-share-line"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="#" target="_blank">
                                                                        <i class="ri-facebook-fill"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" target="_blank">
                                                                        <i class="ri-twitter-x-line"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" target="_blank">
                                                                        <i class="ri-instagram-fill"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" target="_blank">
                                                                        <i class="ri-linkedin-fill"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <button type="button" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Add To Favorites">
                                                            <i class="ri-heart-line"></i>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Compare">
                                                            <i class="ri-arrow-left-right-line"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    </div>

    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    <!-- End Properties Area -->

    <!-- End Rent Area -->

    <!-- Start Fun Facts Area -->
    <div class="fun-facts-area pt-120 pb-95">
        <div class="container">
            <div class="row justify-content-center fun-facts-with-five-columns" data-cues="slideInUp">
                <div class="col">
                    <div class="fun-facts-card">
                        <div class="d-flex align-items-center">
                            <h3 class="counter">12</h3>
                            <h3 class="text">K</h3>
                        </div>
                        <p>Our Happy Customers</p>
                    </div>
                </div>
                <div class="col">
                    <div class="fun-facts-card">
                        <div class="d-flex align-items-center">
                            <h3 class="counter">98</h3>
                            <h3 class="text">%</h3>
                        </div>
                        <p>Clients Satisfaction Rate</p>
                    </div>
                </div>
                <div class="col">
                    <div class="fun-facts-card">
                        <div class="d-flex align-items-center">
                            <h3 class="counter">6</h3>
                            <h3 class="text">+</h3>
                        </div>
                        <p>Our Office Locations</p>
                    </div>
                </div>
                <div class="col">
                    <div class="fun-facts-card">
                        <div class="d-flex align-items-center">
                            <h3 class="counter">20</h3>
                            <h3 class="text">K</h3>
                        </div>
                        <p>Total Property Sale</p>
                    </div>
                </div>
                <div class="col">
                    <div class="fun-facts-card">
                        <div class="d-flex align-items-center">
                            <h3 class="counter">85</h3>
                            <h3 class="text">+</h3>
                        </div>
                        <p>Real Estate Agents</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Facts Area -->

    <!-- Start Featured Properties Area -->
    <div class="featured-properties-area ptb-120">
        <div class="container">
            <div class="section-title text-center" data-cues="slideInUp">
                <h2>Featured Properties</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris eget ornare venenatis, in. Pharetra
                    iaculis consectetur.</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="featured-properties-slide">
                @foreach ($latestProperties as $property)
                    <div class="slide {{ $loop->first ? 'active' : '' }} bg-{{ $loop->iteration }}"
                        style="background-image:url('{{ asset('storage/' . $property->images->first()->image) }}');">
                        <div class="properties-content">
                            <div class="info">
                                <div class="media">
                                    <span><i class="ri-vidicon-fill"></i></span>
                                    <span><i class="ri-image-line"></i>{{ $property->images->count() }}</span>
                                </div>
                                <ul class="group-info">
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="ri-share-line"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                                                <li><a href="#"><i class="ri-twitter-x-line"></i></a></li>
                                                <li><a href="#"><i class="ri-instagram-fill"></i></a></li>
                                                <li><a href="#"><i class="ri-linkedin-fill"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button type="button" data-bs-toggle="tooltip" title="Add To Favorites">
                                            <i class="ri-heart-line"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" data-bs-toggle="tooltip" title="Compare">
                                            <i class="ri-arrow-left-right-line"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="content">
                                <h3><a href="{{route('property.show',$property->id)}}">{{ $property->title }}</a></h3>
                                <span>{{ $property->city }}</span>
                            </div>
                            <ul class="info-list">
                                <li>
                                    <div class="icon"><img
                                            src="{{ asset('assets/images/featured-properties/bed.svg') }}"
                                            alt="bed"></div><span>{{ $property->bedrooms }}</span>
                                </li>
                                <li>
                                    <div class="icon"><img
                                            src="{{ asset('assets/images/featured-properties/bathroom.svg') }}"
                                            alt="bathroom"></div><span>{{ $property->bathrooms }}</span>
                                </li>
                                <li>
                                    <div class="icon"><img
                                            src="{{ asset('assets/images/featured-properties/parking.svg') }}"
                                            alt="parking"></div><span>{{ $property->parking }}</span>
                                </li>
                                <li>
                                    <div class="icon"><img
                                            src="{{ asset('assets/images/featured-properties/area.svg') }}"
                                            alt="area"></div><span>{{ $property->area }}</span>
                                </li>
                            </ul>
                            <div class="price-and-user">
                                <div class="price">${{ $property->price }}</div>
                                <div class="user">
                                    <img src="{{ asset('assets/images/featured-properties/area.svg') }}" alt="image">
                                    <a href="#">{{ $property->broker->name ?? 'No Broker' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- End Featured Properties Area -->

    <!-- Start Properties Area -->
    <div class="properties-area pt-120 pb-95">
        <div class="container">
            <div class="section-title text-center" data-cues="slideInUp">
                <h2>Properties For Sale</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris eget ornare venenatis, in. Pharetra
                    iaculis consectetur.</p>
            </div>
            <div class="row justify-content-center" data-cues="slideInUp">
                @foreach ($sales as $sale)
                    <div class="col-xl-4 col-md-6">
                        <div class="properties-item">
                            <div class="properties-image">
                                <a href="property-details.html">
                                    <img src="{{ asset('storage/' . $property->images->first()->image) }}"
                                        alt="image">
                                </a>
                                <ul class="action">
                                    <li>
                                        <a href="#" class="featured-btn">Featured</a>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <span><i class="ri-vidicon-fill"></i></span>
                                            <span><i class="ri-image-line"></i>{{ $sale->images_count }}</span>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="link-list">
                                    <li>
                                        <a href="#" class="link-btn">Apartment</a>
                                    </li>
                                    <li>
                                        <a href="#" class="link-btn">For Sale</a>
                                    </li>
                                </ul>
                                <ul class="info-list">
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/properties/bed.svg') }}" alt="bed">
                                        </div>
                                        <span>{{ $sale->bedrooms }}</span>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/properties/bathroom.svg') }}" alt="bathroom">
                                        </div>
                                        <span>{{ $sale->bathrooms }}</span>
                                    </li>

                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/properties/area.svg') }}" alt="area">
                                        </div>
                                        <span>{{ $sale->area }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="properties-content">
                                <div class="top">
                                    <div class="title">
                                        <h3>
                                            <a href="{{route('property.show',$property->id)}}">{{ $sale->title }}</a>
                                        </h3>
                                        <span>{{ $sale->address . ', ' . $sale->city }}</span>
                                    </div>
                                    <div class="price">{{ $sale->price }}$</div>
                                </div>
                                <div class="bottom">
                                    <div class="user">
                                        <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                        <a href="agent-profile.html">{{ $property->broker->name ?? 'No Broker' }}</a>
                                    </div>
                                    <ul class="group-info">
                                        <li>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Add To Favorites">
                                                <i class="ri-heart-line"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Compare">
                                                <i class="ri-arrow-left-right-line"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Properties Area -->

    <!-- Start Information Area -->
    <div class="information-area">
        <div class="container">
            <div class="information-inner-area">
                <div class="row justify-content-center align-items-center" data-cues="slideInUp">
                    <div class="col-xl-6 col-md-12">
                        <div class="information-content">
                            <span class="sub">
                                Exploring Unique Homes in the Real Estate Market
                            </span>
                            <h2>Looking To Buy A Property?</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <ul class="information-list">
                            <li>
                                <div class="phone-info">
                                    <div class="icon">
                                        <i class="ri-phone-line"></i>
                                    </div>
                                    <a href="tel:00201068710594">+(002) 0106-8710-594</a>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="default-btn">Find Premium Property</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Information Area -->

    <!-- Start Agents Area -->
    <div class="agents-area pt-120 pb-95">
        <div class="container">
            <div class="section-title text-center" data-cues="slideInUp">
                <h2>Real Estate Agents</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris eget ornare venenatis, in. Pharetra
                    iaculis consectetur.</p>
            </div>
            <div class="row justify-content-center" data-cues="slideInUp">
                @foreach ($agents as $agent)
                    <div class="col-xl-3 col-md-6">
                        <div class="agents-card">
                            <div class="agents-image">
                                <a href="#">
                                    <img src="{{ $agent->profile_image ? asset('storage/' . $agent->profile_image) : asset('assets/images/agents/agents1.jpg') }} "
                                        style="height:200px" alt="image">
                                </a>
                            </div>
                            <div class="agents-content">
                                <h3>
                                    <a href="#  ">{{ $agent->name }}</a>
                                </h3>
                                @if ($agent->bio)
                                    <span>{{ $agent->bio }}</span>
                                @endif
                                @if (is_array($agent->social_links) && count($agent->social_links))
                                    <div class="social-info">
                                        @if (!empty($agent->social_links['facebook']))
                                            <a href="{{ $agent->social_links['facebook'] }}" target="_blank"><i
                                                    class="ri-facebook-fill"></i></a>
                                        @endif
                                        @if (!empty($agent->social_links['twitter']))
                                            <a href="{{ $agent->social_links['twitter'] }}" target="_blank"><i
                                                    class="ri-twitter-x-line"></i></a>
                                        @endif
                                        @if (!empty($agent->social_links['instagram']))
                                            <a href="{{ $agent->social_links['instagram'] }}" target="_blank"><i
                                                    class="ri-instagram-fill"></i></a>
                                        @endif
                                        @if (!empty($agent->social_links['linkedin']))
                                            <a href="{{ $agent->social_links['linkedin'] }}" target="_blank"><i
                                                    class="ri-linkedin-fill"></i></a>
                                        @endif
                                        @if (!empty($agent->social_links['youtube']))
                                            <a href="{{ $agent->social_links['youtube'] }}" target="_blank"><i
                                                    class="ri-youtube-fill"></i></a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Agents Area -->

    <!-- Start Testimonial Area -->
    <div class="testimonial-area pb-120">
        <div class="container-fluid" data-cues="slideInUp">
            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Jordan Williams</h3>
                                    <span>Commercial Property Manager</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li class="gray"><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user2.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Brandon Mitchell</h3>
                                    <span>Project Developer</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user3.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Brandon Mitchell</h3>
                                    <span>Residential Appraiser</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li class="gray"><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Jordan Williams</h3>
                                    <span>Commercial Property Manager</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li class="gray"><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user2.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Brandon Mitchell</h3>
                                    <span>Project Developer</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="info">
                                <div class="image">
                                    <img src="{{ asset('assets/images/user/user3.png') }}" alt="image">
                                </div>
                                <div class="title">
                                    <h3>Brandon Mitchell</h3>
                                    <span>Residential Appraiser</span>
                                </div>
                            </div>
                            <p>“I highly recommend Andora agent to anyone looking to buy or sell a home. They are
                                professional, reliable, and truly care about their clients' needs. They are professional,
                                reliable, and truly care about their clients' needs.”</p>
                            <ul class="rating">
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li class="gray"><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="testimonial-pagination"></div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Area -->

    <!-- Start Blog Area -->
    <div class="blog-area pb-95">
        <div class="container">
            <div class="section-title text-center" data-cues="slideInUp">
                <h2>Latest Articles</h2>

            </div>

            <div class="row justify-content-center" data-cues="slideInUp">
                @foreach ($blogs as $blog)
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-card">
                            <div class="blog-image">
                                <a href="{{route('blog.show',$blog->id)}}">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="image"
                                        style="height: 230px;width: 100%;">
                                </a>
                                <a href="blog-grid.html" class="tag-btn">{{ $blog->title }}</a>
                                <a href="author.html" class="author-btn">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="image">
                                </a>
                            </div>
                            <div class="blog-content">
                                <ul class="meta">
                                    <li>
                                        <i class="ri-calendar-2-line"></i>
                                        {{ $blog->published_at }}
                                    </li>
                                    <li>
                                        <i class="ri-message-2-line"></i>
                                        05
                                    </li>
                                </ul>
                                <h3>
                                    <a
                                        href="blog-details.html">{{ \Illuminate\Support\Str::limit($blog->content, 30) }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog Area -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabLinks = document.querySelectorAll('#search_tab a[data-bs-toggle="tab"]');
            tabLinks.forEach(function (link) {
                link.addEventListener('shown.bs.tab', function (e) {
                    var active = e.target.getAttribute('href').replace('#', '');
                    document.querySelectorAll('form.search-form input[name="tab"]').forEach(function (inp) {
                        inp.value = active;
                    });
                });
            });

            var activeLink = document.querySelector('#search_tab .nav-link.active');
            if (activeLink) {
                var active = activeLink.getAttribute('href').replace('#', '');
                document.querySelectorAll('form.search-form input[name="tab"]').forEach(function (inp) {
                    inp.value = active;
                });
            }
        });
    </script>
@endpush
