@extends('layouts.master')
@section('content')
        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
            <div class="container">
                <div class="page-banner-content">
                    <h2>{{ __('website.properties.page_title') }}</h2>
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
                    @foreach ($properties as $property )

                    <div class="col-xl-4 col-md-6">
                        <div class="properties-item">
                            <div class="properties-image">
                                <a href="">
                                    <img src="{{ $property->images->first() ? asset('storage/' . $property->images->first()->image) : asset('assets/images/properties/properties1.jpg') }}" alt="image">
                                </a>
                                <ul class="action">
                                    <li>
                                        <a href="property-grid.html" class="featured-btn">{{ __('website.properties.featured') }}</a>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <span><i class="ri-vidicon-fill"></i></span>
                                            <span><i class="ri-image-line"></i></span>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="link-list">
                                    <li>
                                        <a href="property-grid.html" class="link-btn">{{ $property->type->name ?? __('website.properties.property_label') }}</a>
                                    </li>
                                    <li>
                                        <a href="property-grid.html" class="link-btn">
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
                                            <a href="{{route('property.show',$property->id)}}">{{ $property->title }}</a>
                                        </h3>
                                        <span>{{ $property->address.' , '. $property->city }}</span>
                                    </div>
                                    <div class="price">{{ $property->price }}$</div>
                                </div>
                                <div class="bottom">
                                    <div class="user">
                                        <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                        <a href="agent-profile.html">{{ $property->broker->name ?? __('website.property.no_broker') }}</a>
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
                                        {{ $properties->links() }}

                </div>
            </div>
        </div>
        <!-- End Properties Area -->



        <!-- Start Subscribe Area -->
        <div class="subscribe-wrap-area">
            <div class="container" data-cues="slideInUp">
                <div class="subscribe-wrap-inner-area">
                    <div class="subscribe-content">
                        <h2>{{ __('website.blog.subscribe_title') }}</h2>
                        <form class="subscribe-form">
                            <input type="search" class="form-control" placeholder="{{ __('website.blog.subscribe_placeholder') }}">
                            <button type="submit" class="default-btn">{{ __('website.blog.subscribe_button') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
