@extends('layouts.master')
@section('content')
    <style>
        .home-category-grid > [class*="col-"],
        .home-latest-properties-grid > [class*="col-"],
        .home-sale-properties-grid > [class*="col-"],
        .home-agents-grid > [class*="col-"],
        .home-blog-grid > [class*="col-"] {
            display: flex;
        }

        .home-category-grid .category-card,
        .home-latest-properties-grid .properties-item,
        .home-sale-properties-grid .properties-item,
        .home-agents-grid .agents-card,
        .home-blog-grid .blog-card {
            width: 100%;
            height: 100%;
        }

        .home-category-grid .category-card .content h3 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .home-latest-properties-grid .properties-item,
        .home-sale-properties-grid .properties-item {
            display: flex;
            flex-direction: column;
        }
        .home-latest-properties-grid .properties-image,
        .home-sale-properties-grid .properties-image {
            height: 250px;
            overflow: hidden;
        }
        .home-latest-properties-grid .properties-image > a,
        .home-sale-properties-grid .properties-image > a {
            display: block;
            height: 100%;
        }
        .home-latest-properties-grid .properties-image > a > img,
        .home-sale-properties-grid .properties-image > a > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .home-latest-properties-grid .properties-content,
        .home-sale-properties-grid .properties-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .home-latest-properties-grid .properties-content .top,
        .home-sale-properties-grid .properties-content .top {
            flex: 1;
        }
        .home-latest-properties-grid .properties-content .top .title h3,
        .home-sale-properties-grid .properties-content .top .title h3 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .home-latest-properties-grid .properties-content .top .title span,
        .home-sale-properties-grid .properties-content .top .title span {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .home-agents-grid .agents-card {
            display: flex;
            flex-direction: column;
        }
        .home-agents-grid .agents-image {
            height: 200px;
            overflow: hidden;
        }
        .home-agents-grid .agents-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .home-agents-grid .agents-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .home-agents-grid .agents-content span {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .home-blog-grid .blog-card {
            display: flex;
            flex-direction: column;
        }
        .home-blog-grid .blog-image {
            height: 230px;
            overflow: hidden;
        }
        .home-blog-grid .blog-image > a > img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .home-blog-grid .blog-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .home-blog-grid .blog-content h3 {
            flex: 1;
        }

        @media (max-width: 768px) {
            .home-latest-properties-grid .properties-image,
            .home-sale-properties-grid .properties-image {
                height: 240px;
            }
        }
    </style>
    <!-- End Responsive Navbar Area -->
       
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
                                                        <label>Your Min Price</label>
                                                        <input type="text" name="price_min" class="form-control"
                                                            placeholder="Min price">
                                                    </div>
                                                </div>

                                                <!-- Lot Size -->
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>Your Max Price</label>
                                                        <input type="text" name="price_max" class="form-control"
                                                            placeholder="Max price">
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

    <div class="compound-search-hero pt-70 pb-70" style="padding-top: 70px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="compound-search-box p-4 p-md-5" style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 18px 45px rgba(15, 25, 54, 0.12);">
                        <div class="text-center mb-4">
                            <h2 class="mb-2" style="font-weight: 700; letter-spacing: 0.08em;">DISCOVER YOUR NEXT HOME</h2>
                            <p class="mb-0 text-muted">Search and compare among thousands of properties and prime compounds</p>
                        </div>
                        <ul class="nav nav-tabs justify-content-center" id="compound_search_tabs" role="tablist" style="border-bottom: 1px solid #e5e7eb;">
                            <li class="nav-item">
                                <a class="nav-link active" id="compound_tab_compounds" data-bs-toggle="tab" href="#compound_tab_compounds_content" role="tab">
                                    Compounds
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="compound_tab_properties" data-bs-toggle="tab" href="#compound_tab_properties_content" role="tab">
                                    Properties
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3" id="compound_search_tabs_content">
                            <div class="tab-pane fade show active" id="compound_tab_compounds_content" role="tabpanel">
                                <form class="compound-search-form">
                                    <input type="hidden" name="type" value="compound">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-lg-4 col-md-6 position-relative">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Search</label>
                                                <input type="text"
                                                       class="form-control compound-search-input"
                                                       placeholder="Area, Compound, Real Estate Developer"
                                                       autocomplete="off"
                                                       style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                            </div>
                                            <div class="list-group position-absolute w-100 compound-search-suggestions"
                                                 style="z-index: 1000; max-height: 260px; overflow-y: auto; display: none; border-radius: 0 0 16px 16px; box-shadow: 0 18px 45px rgba(15,25,54,0.12);"></div>
                                        </div>
                                      
                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Beds and Baths</label>
                                                <select class="form-select"
                                                        style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                                    <option selected>Beds and Baths</option>
                                                    <option value="1">1+</option>
                                                    <option value="2">2+</option>
                                                    <option value="3">3+</option>
                                                    <option value="4">4+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Price Range</label>
                                                <select class="form-select compound-price-range"
                                                        style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                                    <option selected>Price Range</option>
                                                    <option value="0-1000000">Up to 1,000,000</option>
                                                    <option value="1000000-3000000">1,000,000 - 3,000,000</option>
                                                    <option value="3000000-6000000">3,000,000 - 6,000,000</option>
                                                    <option value="6000000-0">6,000,000+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="d-grid">
                                                <button type="button" class="default-btn w-100 compound-search-button">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="compound_tab_properties_content" role="tabpanel">
                                <form class="compound-search-form">
                                    <input type="hidden" name="type" value="property">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-lg-4 col-md-6 position-relative">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Search</label>
                                                <input type="text"
                                                       class="form-control compound-search-input"
                                                       placeholder="Area, Compound, Real Estate Developer"
                                                       autocomplete="off"
                                                       style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                            </div>
                                            <div class="list-group position-absolute w-100 compound-search-suggestions"
                                                 style="z-index: 1000; max-height: 260px; overflow-y: auto; display: none; border-radius: 0 0 16px 16px; box-shadow: 0 18px 45px rgba(15,25,54,0.12);"></div>
                                        </div>
                       
                                        <div class="col-lg-3 col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Beds and Baths</label>
                                                <select class="form-select"
                                                        style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                                    <option selected>Beds and Baths</option>
                                                    <option value="1">1+</option>
                                                    <option value="2">2+</option>
                                                    <option value="3">3+</option>
                                                    <option value="4">4+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label mb-1">Price Range</label>
                                                <select class="form-select compound-price-range"
                                                        style="border-radius: 12px; border-color: #e5e7eb; box-shadow: 0 1px 2px rgba(15,23,42,0.04);">
                                                    <option selected>Price Range</option>
                                                    <option value="0-1000000">Up to 1,000,000</option>
                                                    <option value="1000000-3000000">1,000,000 - 3,000,000</option>
                                                    <option value="3000000-6000000">3,000,000 - 6,000,000</option>
                                                    <option value="6000000-0">6,000,000+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="d-grid">
                                                <button type="button" class="default-btn w-100 compound-search-button">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category-area pt-120 pb-95">
        <div class="container">
            <div class="row justify-content-center home-category-grid" data-cues="slideInUp">
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

                        <div class="row justify-content-center home-latest-properties-grid" data-cues="slideInUp">
                            @foreach ($latestProperties as $property)
                                <div class="col-xl-4 col-md-6">
                                    <div class="properties-item">
                                        <div class="properties-image">
                                            <a href="#">
                                                <img src="{{ $property->images->first() ? asset('storage/' . $property->images->first()->image) : asset('assets/images/properties/properties1.jpg') }}"
                                                    alt="image">
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
                                                <div class="price">{{ number_format($property->price) }} EGP</div>
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
                                <div class="price">EGY{{ $property->price }}</div>
                                <div class="user">
                                    <img src="{{ asset('assets/images/featured-properties/area.svg') }}" alt="image">
                                    <a href="#">{{ $property->broker->name ?? __('website.property.no_broker') }}</a>
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
                <h2>{{ __('website.home.properties_for_sale_title') }}</h2>
                <p>{{ __('website.home.properties_for_sale_subtitle') }}</p>
            </div>
            <div class="row justify-content-center home-sale-properties-grid" data-cues="slideInUp">
                @foreach ($sales as $sale)
                    <div class="col-xl-4 col-md-6">
                        <div class="properties-item">
                            <div class="properties-image">
                                <a href="{{ route('property.show', $sale->id) }}">
                                    <img src="{{ $sale->images->first() ? asset('storage/' . $sale->images->first()->image) : asset('assets/images/properties/properties1.jpg') }}" alt="image">
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
                                            <a href="{{ route('property.show', $sale->id) }}">{{ $sale->title }}</a>
                                        </h3>
                                        <span>{{ $sale->address . ', ' . $sale->city }}</span>
                                    </div>
                                    <div class="price">{{ $sale->price }} EGY</div>
                                </div>
                                <div class="bottom">
                                    <div class="user">
                                        <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                        <a href="#">{{ $sale->broker->name ?? __('website.property.no_broker') }}</a>
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
                                {{ __('website.home.info_subtitle') }}
                            </span>
                            <h2>{{ __('website.home.info_title') }}</h2>
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
                                <a href="#" class="default-btn">{{ __('website.home.info_button') }}</a>
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
                <h2>{{ __('website.home.agents_title') }}</h2>
                <p>{{ __('website.home.agents_subtitle') }}</p>
            </div>
            <div class="row justify-content-center home-agents-grid" data-cues="slideInUp">
                @foreach ($agents as $agent)
                    <div class="col-xl-3 col-md-6">
                        <div class="agents-card">
                            <div class="agents-image">
                                <a href="#">
                                    <img src="{{ $agent->profile_image ? asset('storage/' . $agent->profile_image) : asset('assets/images/agents/agents1.jpg') }} "
                                        alt="image">
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

            <div class="row justify-content-center home-blog-grid" data-cues="slideInUp">
                @foreach ($blogs as $blog)
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-card">
                            <div class="blog-image">
                                <a href="{{route('blog.show',$blog->id)}}">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="image">
                                </a>
                                <a href="{{route('blog.show',$blog->id)}}" class="tag-btn">{{ $blog->title }}</a>
                                <a href="{{route('blog.show',$blog->id)}}" class="author-btn">
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
                                        href="{{route('blog.show',$blog->id)}}">{{ \Illuminate\Support\Str::limit($blog->content, 30) }}</a>
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

            function setupCompoundSearch(form) {
                var typeInput = form.querySelector('input[name="type"]');
                var searchInput = form.querySelector('.compound-search-input');
                var suggestions = form.querySelector('.compound-search-suggestions');
                var priceSelect = form.querySelector('.compound-price-range');
                var button = form.querySelector('.compound-search-button');
                var debounceTimer = null;

                function clearSuggestions() {
                    suggestions.innerHTML = '';
                    suggestions.style.display = 'none';
                }

                function renderSuggestions(items) {
                    suggestions.innerHTML = '';
                    if (!items || !items.length) {
                        suggestions.style.display = 'none';
                        return;
                    }
                    items.forEach(function (item) {
                        var a = document.createElement('a');
                        a.className = 'list-group-item list-group-item-action';
                        var name = item.name || '';
                        var city = item.city || '';
                        var type = item.type || '';

                        var label = name;
                        if (city) {
                            label += ' • ' + city;
                        }

                        a.href = item.url;
                        a.innerHTML = `
                            <div class="d-flex align-items-center">
                                <div class="me-2"
                                     style="width:32px;height:32px;border-radius:999px;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                                    <i class="ri-building-2-line" style="color:#1d4ed8;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div style="font-weight:500;">${label}</div>
                                    ${type ? `<small class="text-muted" style="font-size:0.75rem;">${type}</small>` : ''}
                                </div>
                            </div>
                        `;

                        suggestions.appendChild(a);
                    });
                    suggestions.style.display = 'block';
                }

                function fetchSuggestions(term) {
                    var params = new URLSearchParams();
                    if (term) {
                        params.set('q', term);
                    }
                    if (typeInput && typeInput.value) {
                        params.set('type', typeInput.value);
                    }
                    var query = params.toString();
                    var url = '{{ route('projects.autocomplete') }}' + (query ? '?' + query : '');
                    fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                        .then(function (response) { return response.json(); })
                        .then(function (data) {
                            renderSuggestions(data.data || []);
                        })
                        .catch(function () {
                            clearSuggestions();
                        });
                }

                searchInput.addEventListener('input', function () {
                    var term = searchInput.value.trim();
                    if (debounceTimer) {
                        clearTimeout(debounceTimer);
                    }
                    debounceTimer = setTimeout(function () {
                        fetchSuggestions(term);
                    }, 250);
                });

                searchInput.addEventListener('focus', function () {
                    var term = searchInput.value.trim();
                    fetchSuggestions(term);
                });

                document.addEventListener('click', function (e) {
                    if (!form.contains(e.target)) {
                        clearSuggestions();
                    }
                });

                button.addEventListener('click', function () {
                    var params = new URLSearchParams();
                    if (typeInput && typeInput.value) {
                        params.set('type', typeInput.value);
                    }
                    var term = searchInput.value.trim();
                    if (term) {
                        params.set('q', term);
                    }
                    if (priceSelect && priceSelect.value && priceSelect.value.indexOf('-') !== -1) {
                        var parts = priceSelect.value.split('-');
                        if (parts[0] && parts[0] !== '0') {
                            params.set('price_min', parts[0]);
                        }
                        if (parts[1] && parts[1] !== '0') {
                            params.set('price_max', parts[1]);
                        }
                    }
                    var url = '{{ route('projects.index') }}' + '?' + params.toString();
                    window.location.href = url;
                });
            }

            document.querySelectorAll('.compound-search-form').forEach(function (form) {
                setupCompoundSearch(form);
            });
        });
    </script>
@endpush
