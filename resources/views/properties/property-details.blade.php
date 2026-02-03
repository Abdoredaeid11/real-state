@extends('layouts.master')
@section('content')

        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
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
                                            <a href="property-grid.html" class="featured-btn">
                                                {{ __('website.property.featured') }}
                                            </a>
                                        </div>
                                        <span class="address">
                                            @if(app()->getLocale() == 'ar')
                                                {{ ($property->address_ar ?? $property->address).' , '.($property->city_ar ?? $property->city) }}
                                            @else
                                                {{ $property->address.' , '.$property->city }}
                                            @endif
                                        </span>
                                        <ul class="info-list">
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/property-details/bed.svg') }}" alt="bed">
                                                </div>
                                                <span>{{$property->bedrooms}} {{ __('website.property.bedroom') }}</span>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/property-details/bathroom.svg') }}" alt="bathroom">
                                                </div>
                                                <span>{{$property->bathrooms}} {{ __('website.property.bathroom') }}</span>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/images/property-details/area.svg') }}" alt="area">
                                                </div>
                                                <span>{{$property->area}} {{ __('website.property.area') }}</span>
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
                                <div class="col-lg-5 col-md-12">
                                    <div class="right-content">
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
                                        <div class="price">{{$property->price}} EGP</div>
                                        <div class="user">
                                            <img src="{{ asset('assets/images/user/user1.png') }}" alt="image">
                                            <a href="agent-profile.html">{{ $property->broker->name ?? __('website.property.no_broker') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="property-details-image">
                            <div class="row justify-content-center align-items-center">

                                <div class="col-lg-12 col-md-12">
                                    @php
                                        $propertyImages = $property->images ?? collect();
                                        $firstPropertyImage = $propertyImages->first();
                                        $fallbackImage = asset('assets/images/property-details/property-details-large.jpg');
                                        $firstPropertyImageUrl = $firstPropertyImage ? asset('storage/' . $firstPropertyImage->image) : $fallbackImage;
                                    @endphp

                                    <div class="block-image">
                                        <a href="{{ $firstPropertyImageUrl }}" data-fslightbox="property-gallery" style="display: block; position: relative; overflow: hidden; border-radius: 12px; height: clamp(260px, 45vw, 520px);">
                                            <div style="position: absolute; inset: 0; background-image: url('{{ $firstPropertyImageUrl }}'); background-size: cover; background-position: center; filter: blur(18px); transform: scale(1.12);"></div>
                                            <img src="{{ $firstPropertyImageUrl }}" alt="image" style="position: relative; z-index: 1; width: 100%; height: 100%; object-fit: contain;">
                                        </a>
                                    </div>

                                    @if($propertyImages->count() > 1)
                                        <div class="text-center mt-3">
                                            <button type="button" class="default-btn" data-bs-toggle="collapse" data-bs-target="#property-images-collapse" aria-expanded="false" aria-controls="property-images-collapse">
                                                عرض الصور
                                            </button>
                                        </div>

                                        <div class="collapse mt-4" id="property-images-collapse">
                                            <div class="row justify-content-center g-3">
                                                @foreach($propertyImages->skip(1) as $img)
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="block-image">
                                                            <a href="{{ asset('storage/' . $img->image) }}" data-fslightbox="property-gallery">
                                                                <img src="{{ asset('storage/' . $img->image) }}" alt="image" style="width: 100%; height: 140px; object-fit: cover;">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="property-details-inner-content">
                            <div class="row justify-content-center">
                                <div class="col-xl-8 col-md-12">
                                    <div class="description">
                                        <h3>{{ __('website.property.description_title') }}</h3>
                                        <p>{{$property->description}} </p>
                                        <p>Gravida nibh vel velit auctor aliquet. Aenean sollicitudin quis bibendum auctor, nisilit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi acnec tellus a odio tincidunt auctor a ornare odio.</p>
                                    </div>
                                    <div class="overview">
                                        <h3>{{ __('website.property.overview_title') }}</h3>
                                        <ul class="overview-list" style="display: flex; gap: 58px;">
                                            <li>
                                                <img src="{{ asset('assets/images/property-details/bed2.svg') }}" alt="bed2">
                                                <h4>{{ __('website.property.bedrooms_label') }}</h4>
                                                <span>{{$property->bedrooms}} {{ __('website.property.bedrooms_label') }}</span>
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/images/property-details/bathroom2.svg') }}" alt="bathroom2">
                                                <h4>{{ __('website.property.bathroom') }}</h4>
                                                <span>{{$property->bathrooms}} {{ __('website.property.bathroom') }}</span>
                                            </li>

                                            <li>
                                                <img src="{{ asset('assets/images/property-details/area2.svg') }}" alt="area2">
                                                <h4>{{ __('website.property.accommodation_label') }}</h4>
                                                <span>{{$property->area}} Sq Ft</span>
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/images/property-details/home.svg') }}" alt="home">
                                                <h4>{{ __('website.forms.property_type') ?? 'Property Type' }}</h4>
                                                <span>Entire Place / Apartment</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="features">
                                        <h3>{{ __('website.property.facts_and_features_title') }}</h3>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4 col-md-4">
                                                <ul class="list">
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Air Conditioning
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Dishwasher
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Internet
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Supermarket/Store
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Build-In Wardrobes
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <ul class="list">
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Fencing
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Park
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Swimming Pool
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Clinic
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Floor Coverings
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <ul class="list">
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        School
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Transportation Hub
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Gym Availability
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Lawn
                                                    </li>
                                                    <li>
                                                        <i class="ri-check-double-fill"></i>
                                                        Security Guard
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="floor-plan">
                                        <div class="title">
                                            <h3>Floor Plan</h3>
                                            <ul class="info-list">
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/property-details/bed.svg') }}" alt="bed">
                                                    </div>
                                                    <span>6</span>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/property-details/bathroom.svg') }}" alt="bathroom">
                                                    </div>
                                                    <span>4</span>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/property-details/parking.svg') }}" alt="parking">
                                                    </div>
                                                    <span>1</span>
                                                </li>
                                                <li>
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/property-details/area.svg') }}" alt="area">
                                                    </div>
                                                    <span>3250</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="floor-image">
                                            <img src="{{ asset('assets/images/property-details/floor-plan.jpg') }}" alt="image">
                                        </div>
                                    </div>

                                    <div class="location">
                                        <div class="title">
                                            <h3>{{ __('website.property.location_title') }}</h3>
                                            <p>
                                                @if(app()->getLocale() == 'ar')
                                                    {{ ($property->address_ar ?? $property->address).' , '.($property->city_ar ?? $property->city) }}
                                                @else
                                                    {{ $property->address.' , '.$property->city }}
                                                @endif
                                            </p>
                                        </div>
                                        @php
                                            $mapSrc = null;
                                            if (!is_null($property->latitude) && !is_null($property->longitude)) {
                                                $mapSrc = 'https://www.google.com/maps?q=' . $property->latitude . ',' . $property->longitude . '&z=15&output=embed';
                                            } elseif (!empty($property->map_url)) {
                                                $mapSrc = $property->map_url;
                                            }
                                        @endphp

                                        @if($mapSrc)
                                            <iframe src="{{ $mapSrc }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        @endif
                                    </div>
                                    <div class="conclusion">
                                        <h3>Conclusion</h3>
                                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin quis bibendum auctor, nisilit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu.</p>
                                        <p>Gravida nibh vel velit auctor aliquet. Aenean sollicitudin quis bibendum auctor, nisilit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi acnec tellus a odio tincidunt auctor a ornare odio.</p>
                                    </div>

                                </div>
                                <div class="col-xl-4 col-md-12">
                                    <div class="property-details-sidebar">
                                        <div class="booking">
                                            <form method="POST" action="{{ route('reservations.store') }}">
                                                @csrf
                                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                                @if($property->broker_id)
                                                    <input type="hidden" name="broker_id" value="{{ $property->broker_id }}">
                                                @endif
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="customer_name" placeholder="Your name" class="form-control" required>
                                                    <div class="icon">
                                                        <i class="ri-user-3-line"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="customer_email" placeholder="Your email" class="form-control" required>
                                                    <div class="icon">
                                                        <i class="ri-mail-send-line"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone No.</label>
                                                    <input type="text" name="customer_phone" placeholder="+12345678" class="form-control" required>
                                                    <div class="icon">
                                                        <i class="ri-phone-line"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group extra-top">
                                                    <label>Description</label>
                                                    <textarea name="notes" class="form-control" placeholder="I'm interested in this property......." rows="5"></textarea>
                                                    <div class="icon">
                                                        <i class="ri-pencil-line"></i>
                                                    </div>
                                                </div>
                                                <button type="submit" class="default-btn">Submit Request</button>
                                            </form>
                                        </div>
                                        <div class="featured-properties">
                                            <h3>Featured Properties</h3>
                                            <div class="swiper featured-properties-slider">
                                                <div class="swiper-wrapper">
                                                    @if(isset($related) && $related->isNotEmpty())
                                                        @foreach($related as $fp)
                                                            @php $fpImgs = $fp->images ?? collect(); $first = $fpImgs->first(); @endphp
                                                            <div class="swiper-slide">
                                                                <div class="properties-item">
                                                                    <div class="properties-image">
                                                                        <a href="{{ url('properties/'.$fp->id) }}">
                                                                            <img src="{{ $first ? asset('storage/' . $first->image) : asset('assets/images/properties/properties1.jpg') }}" alt="image">
                                                                        </a>
                                                                        <ul class="action">
                                                                            @if(strtolower($fp->status ?? '') == 'featured')
                                                                                <li>
                                                                                    <a href="#" class="featured-btn">Featured</a>
                                                                                </li>
                                                                            @endif
                                                                            <li>
                                                                                <div class="media">
                                                                                    <span><i class="ri-vidicon-fill"></i></span>
                                                                                    <span><i class="ri-image-line"></i>{{ $fpImgs->count() }}</span>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="link-list">
                                                                            <li>
                                                                                <a href="#" class="link-btn">{{ $fp->type?->name ?? ucfirst($fp->type ?? 'Apartment') }}</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#" class="link-btn">{{ ucfirst($fp->status ?? 'For Sale') }}</a>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="info-list">
                                                                            <li>
                                                                                <div class="icon">
                                                                                    <img src="{{ asset('assets/images/properties/bed.svg') }}" alt="bed">
                                                                                </div>
                                                                                <span>{{ $fp->bedrooms ?? '-' }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <div class="icon">
                                                                                    <img src="{{ asset('assets/images/properties/bathroom.svg') }}" alt="bathroom">
                                                                                </div>
                                                                                <span>{{ $fp->bathrooms ?? '-' }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <div class="icon">
                                                                                    <img src="{{ asset('assets/images/properties/parking.svg') }}" alt="parking">
                                                                                </div>
                                                                                <span>{{ $fp->parking ?? '-' }}</span>
                                                                            </li>
                                                                            <li>
                                                                                <div class="icon">
                                                                                    <img src="{{ asset('assets/images/properties/area.svg') }}" alt="area">
                                                                                </div>
                                                                                <span>{{ $fp->area ?? '-' }}</span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="properties-content">
                                                                        <div class="top">
                                                                            <div class="title">
                                                                                <h3>
                                                                                    <a href="{{ url('properties/'.$fp->id) }}">{{ $fp->title }}</a>
                                                                                </h3>
                                                                                <span>{{ $fp->address . ', ' . $fp->city }}</span>
                                                                            </div>
                                                                            <div class="price">{{ $fp->price }} EGP</div>
                                                                        </div>
                                                                        <div class="bottom">
                                                                            <div class="user">
                                                                                <img src="{{ $fp->broker && $fp->broker->image ? asset('storage/' . $fp->broker->image) : asset('assets/images/user/user1.png') }}" alt="image">
                                                                                <a href="#">{{ $fp->broker?->name ?? 'Agent' }}</a>
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
                                                        @endforeach
                                                    @else
                                                        {{-- fallback: keep static slides if no featuredProperties provided --}}
                                                        <div class="swiper-slide">
                                                            <div class="properties-item">
                                                                <div class="properties-image">
                                                                    <a href="property-details.html">
                                                                        <img src="{{ asset('assets/images/properties/properties1.jpg') }}" alt="image">
                                                                    </a>
                                                                    <ul class="action">
                                                                        <li>
                                                                            <a href="property-grid.html" class="featured-btn">Featured</a>
                                                                        </li>
                                                                        <li>
                                                                            <div class="media">
                                                                                <span><i class="ri-vidicon-fill"></i></span>
                                                                                <span><i class="ri-image-line"></i>5</span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="link-list">
                                                                        <li>
                                                                            <a href="property-grid.html" class="link-btn">Apartment</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="property-grid.html" class="link-btn">For Sale</a>
                                                                        </li>
                                                                    </ul>
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
                                                    @endif
                                                </div>
                                                <div class="properties-pagination"></div>
                                            </div>
                                        </div>
                                        <div class="contact-details">
                                            <h3>Contact Details</h3>
                                            <ul class="list">
                                                <li>
                                                    <span>Email:</span>
                                                    <a href="mailto:contact@hello.com">contact@hello.com</a>
                                                </li>
                                                <li>
                                                    <span>Phone:</span>
                                                    <a href="tel:01234567890">0123 456 7890</a>
                                                </li>
                                                <li>
                                                    <span>Location:</span>
                                                    New York, USA
                                                </li>
                                            </ul>
                                        </div>
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
