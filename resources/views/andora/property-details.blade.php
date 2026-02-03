@extends('layouts.master')
@section('content')

    <!-- Start Page Banner Area -->
    <div class="page-banner-area" style="background: linear-gradient(180deg, rgba(7,89,133,0.03), rgba(255,255,255,0));">
        <div class="container">
            <div class="page-banner-content">
                <h2>{{ __('website.property.details_title') }}</h2>
                <ul class="list">
                    <li>
                        <a href="{{ route('home.index') }}">{{ __('website.property.breadcrumb_home') }}</a>
                    </li>
                    <li>{{ __('website.property.breadcrumb_current') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Property Details Area -->
    <div class="property-details-area ptb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="property-details-desc">
                    <div class="property-details-content">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-7 col-md-12">
                                <div class="left-content">
                                    <div class="title">
                                        <h2>{{ app()->getLocale() == 'ar' ? ($property->title_ar ?? $property->title) : $property->title }}</h2>
                                        @if(!empty($property->featured) || ($property->is_featured ?? false))
                                            <a href="#" class="featured-btn">Featured</a>
                                        @endif
                                    </div>
                                    <span class="address">{{ app()->getLocale() == 'ar' ? ($property->address_ar ?? $property->address) : $property->address }}{{ $property->city ? ', ' . (app()->getLocale() == 'ar' ? ($property->city_ar ?? $property->city) : $property->city) : '' }}</span>
                                    <ul class="info-list">
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/property-details/bed.svg') }}" alt="bed">
                                            </div>
                                            <span>{{ $property->bedrooms ?? '-' }} {{ __('website.property.bedroom') }}</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/property-details/bathroom.svg') }}" alt="bathroom">
                                            </div>
                                            <span>{{ $property->bathrooms ?? '-' }} {{ __('website.property.bathroom') }}</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/property-details/parking.svg') }}" alt="parking">
                                            </div>
                                            <span>{{ $property->parking ?? '-' }} Parking</span>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/property-details/area.svg') }}" alt="area">
                                            </div>
                                            <span>{{ $property->area ?? '-' }} {{ __('website.property.area') }}</span>
                                        </li>
                                    </ul>
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
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('website.property.add_to_favorites') }}">
                                                <i class="ri-heart-line"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('website.property.compare') }}">
                                                <i class="ri-arrow-left-right-line"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="right-content">
                                    <ul class="link-list">
                                        <li>
                                            <a href="#" class="link-btn">{{ $property->type->name ?? $property->type ?? 'Property' }}</a>
                                        </li>
                                        <li>
                                            <a href="#" class="link-btn">{{ ucfirst($property->status ?? '') }}</a>
                                        </li>
                                    </ul>
                                    <div class="price">${{ number_format($property->price ?? 0) }}</div>
                                    <div class="user">
                                        <img src="{{ $property->broker && $property->broker->image ? asset('storage/' . $property->broker->image) : asset('assets/images/user/user1.png') }}" alt="image">
                                        <a href="#">{{ $property->broker->name ?? __('website.property.no_broker') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="property-details-image">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4 col-md-12">
                                <div class="row justify-content-center">
                                    @forelse($property->images->take(4) as $img)
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="block-image">
                                                <img src="{{ asset('storage/' . $img->image) }}" alt="image">
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="block-image">
                                                <img src="{{ asset('assets/images/property-details/property-details1.jpg') }}" alt="image">
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-12">
                                <div class="properties-slider">
                                    <div class="swiper-wrapper">
                                        @forelse($property->images as $img)
                                            <div class="swiper-slide">
                                                <div class="single-properties">
                                                    <img src="{{ asset('storage/' . $img->image) }}" alt="image">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="swiper-slide">
                                                <div class="single-properties">
                                                    <img src="{{ asset('assets/images/property-details/property-details1.jpg') }}" alt="image">
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="properties-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="property-details-information">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="properties-details-content">
                                    <h3>{{ __('website.property.description_title') }}</h3>
                                    <p>{{ app()->getLocale() == 'ar' ? ($property->description_ar ?? $property->description) : $property->description }}</p>

                                    <h3>{{ __('website.property.gallery_title') }}</h3>
                                    <div class="row">
                                        @forelse($property->images->take(6) as $img)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="gallery-image">
                                                    <img src="{{ asset('storage/' . $img->image) }}" alt="image">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="gallery-image">
                                                    <img src="{{ asset('assets/images/property-details/property-details1.jpg') }}" alt="image">
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                    @if($property->features && $property->features->count())
                                        <h3>{{ __('website.property.features_title') }}</h3>
                                        <ul class="features-list">
                                            @foreach($property->features as $feature)
                                                <li>{{ app()->getLocale() == 'ar' ? ($feature->name_ar ?? $feature->name) : $feature->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if(!empty($property->map_embed))
                                        <h3>{{ __('website.property.location_title') }}</h3>
                                        <div class="map-area">
                                            {!! $property->map_embed !!}
                                        </div>
                                    @elseif($property->address || $property->city)
                                        <h3>{{ __('website.property.location_title') }}</h3>
                                        <div class="map-area">
                                            <iframe
                                                src="https://www.google.com/maps?q={{ urlencode(($property->address ?? '') . ' ' . ($property->city ?? '')) }}&output=embed"
                                                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="sidebar-area">
                                    <div class="contact-form">
                                        <h3>{{ __('website.property.request_info_title') }}</h3>
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ __('website.contact.name_placeholder') }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="{{ __('website.contact.email_placeholder') }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{ __('website.contact.phone_placeholder') }}">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="{{ __('website.contact.message_placeholder') }}"></textarea>
                                            </div>
                                            <button class="default-btn" type="submit">{{ __('website.contact.send_button') }}</button>
                                        </form>
                                    </div>

                                    <div class="related-properties">
                                        <h3>{{ __('website.property.related_properties_title') }}</h3>
                                            <div class="related-properties-slider">
                                                @forelse($related as $r)
                                                    <div class="single-related-properties">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <img src="{{ $r->images->first() ? asset('storage/' . $r->images->first()->image) : asset('assets/images/property-details/property-details1.jpg') }}" alt="image">
                                                            </div>
                                                            <div class="col-7">
                                                                <h4><a href="{{ url('property/'.$r->id) }}">{{ $r->title }}</a></h4>
                                                                <span>${{ number_format($r->price ?? 0) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="single-related-properties">
                                                        <div class="row align-items-center">
                                                            <div class="col-5">
                                                                <img src="{{ asset('assets/images/property-details/property-details1.jpg') }}" alt="image">
                                                            </div>
                                                            <div class="col-7">
                                                                <h4><a href="#">No related properties</a></h4>
                                                                <span>-</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        <div class="properties-pagination"></div>
                                    </div>

                                    @if($property->broker || $property->address || $property->city)
                                        <div class="contact-details">
                                            <h3>Contact Details</h3>
                                            <ul class="list">
                                                @if($property->broker && !empty($property->broker->email))
                                                    <li>
                                                        <span>Email:</span>
                                                        <a href="mailto:{{ $property->broker->email }}">{{ $property->broker->email }}</a>
                                                    </li>
                                                @endif

                                                @if($property->broker && !empty($property->broker->phone))
                                                    <li>
                                                        <span>Phone:</span>
                                                        <a href="tel:{{ $property->broker->phone }}">{{ $property->broker->phone }}</a>
                                                    </li>
                                                @endif

                                                @if($property->address || $property->city)
                                                    <li>
                                                        <span>Location:</span>
                                                        {{ app()->getLocale() == 'ar' ? ($property->address_ar ?? $property->address) : $property->address }}{{ $property->city ? ', ' . (app()->getLocale() == 'ar' ? ($property->city_ar ?? $property->city) : $property->city) : '' }}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Property Details Area -->

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

@endsection
