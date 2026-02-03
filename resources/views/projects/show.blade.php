@extends('layouts.master')

@section('content')

 <!-- Start Page Banner Area -->
        <div class="page-banner-area" style="margin-bottom:50px">
            <div class="container">
                <div class="page-banner-content">
                    <h2>{{ __('project Details') }}</h2>
                    <ul class="list">
                        <li>
                            <a href="{{ route('home.index') }}">{{ __('website.properties.breadcrumb_home') }}</a>
                        </li>
                        <li>{{ __('Project Details') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner Area -->




    <!-- Hero Section مع صور متعددة -->
    <div class="project-hero-section">
        <div class="hero-slider">
            @if($project->images->count() > 0)
                @foreach($project->images->take(3) as $image)
                    <div class="hero-slide" 
                         style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ asset('storage/' . $image->image) }}') center center / cover no-repeat;">
                    </div>
                @endforeach
            @else
                <div class="hero-slide" 
                     style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/images/properties/properties1.jpg') }}') center center / cover no-repeat;">
                </div>
            @endif
        </div>
        
        <div class="container position-relative" style="z-index: 2;">
            <div class="hero-content py-lg-6">
                <!-- Breadcrumb -->
              
                
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <!-- Tags -->
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary bg-opacity-20 border border-primary border-opacity-25 px-3 py-2">
                                @if($project->type === 'compound')
                                    <i class="ri-building-4-line me-1"></i>
                                    @if(app()->getLocale() == 'ar') كمبوند @else Compound @endif
                                @else
                                    <i class="ri-home-4-line me-1"></i>
                                    @if(app()->getLocale() == 'ar') مشروع @else Project @endif
                                @endif
                            </span>
                            
                            @if($project->delivery_year)
                                <span class="badge bg-success bg-opacity-20 border border-success border-opacity-25 px-3 py-2">
                                    <i class="ri-calendar-2-line me-1"></i>
                                    @if(app()->getLocale() == 'ar')
                                        تسليم {{ $project->delivery_year }}
                                    @else
                                        Delivery {{ $project->delivery_year }}
                                    @endif
                                </span>
                            @endif
                            
                            @if($project->installments_up_to)
                                <span class="badge bg-info bg-opacity-20 border border-info border-opacity-25 px-3 py-2">
                                    <i class="ri-time-line me-1"></i>
                                    @if(app()->getLocale() == 'ar')
                                        تقسيط حتى {{ $project->installments_up_to }} سنة
                                    @else
                                        Installments up to {{ $project->installments_up_to }} years
                                    @endif
                                </span>
                            @endif
                        </div>
                        
                        <!-- Title -->
                        <h1 class="display-5 fw-bold mb-3">
                            {{ app()->getLocale() == 'ar' ? ($project->name_ar ?: $project->name) : $project->name }}
                        </h1>
                        
                        <!-- Location & Developer -->
                        <div class="d-flex align-items-center flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="ri-map-pin-2-line fs-5 me-2"></i>
                                <span>
                                    {{ app()->getLocale() == 'ar' ? ($project->city_ar ?: $project->city) : $project->city }}
                                    @if($project->location_text)
                                        , {{ $project->location_text }}
                                    @endif
                                </span>
                            </div>
                            
                            @if($project->developer)
                                <div class="d-flex align-items-center ">
                                    <i class="ri-building-line fs-5 me-2"></i>
                                    <span>{{ $project->developer }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Starting Price -->
                        @if($project->starting_price)
                            <div class="price-card bg-white bg-opacity-10 backdrop-blur rounded-3 p-4 d-inline-block">
                                <div class="text-white-80 fw-semibold mb-1">
                                    @if(app()->getLocale() == 'ar')
                                        الأسعار تبدأ من
                                    @else
                                        Prices starting from
                                    @endif
                                </div>
                                <div class="display-6 fw-bold ">
                                    {{ $project->price_currency ?: 'EGP' }}
                                    {{ number_format($project->starting_price, 0) }}
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <!-- CTA Buttons -->
                        <div class="cta-buttons bg-white rounded-3 p-4 shadow-lg">
                            <h5 class="mb-3">
                                @if(app()->getLocale() == 'ar')
                                    استفسر عن هذا المشروع
                                @else
                                    Inquire about this project
                                @endif
                            </h5>
                            
                            <button class="btn btn-primary w-100 mb-3 py-3 d-flex align-items-center justify-content-center">
                                <i class="ri-phone-line me-2 fs-5"></i>
                                @if(app()->getLocale() == 'ar')
                                    <span>طلب مكالمة</span>
                                @else
                                    <span>Request a Call</span>
                                @endif
                            </button>
                            
                            <button class="btn btn-outline-primary w-100 py-3 d-flex align-items-center justify-content-center">
                                <i class="ri-whatsapp-line me-2 fs-5"></i>
                                @if(app()->getLocale() == 'ar')
                                    <span>تواصل عبر واتساب</span>
                                @else
                                    <span>Contact via WhatsApp</span>
                                @endif
                            </button>
                            
                            <div class="text-center mt-3">
                                <div class="text-muted small">
                                    @if(app()->getLocale() == 'ar')
                                        رد فوري خلال ٢٤ ساعة
                                    @else
                                        Instant response within 24 hours
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Main Content -->
    <div class="project-content-section py-5">
        <div class="container">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- Overview Section -->
                    <section id="overview" class="mb-5 pt-4">
                        <h2 class="mb-4 fw-bold">
                            @if(app()->getLocale() == 'ar')
                                <i class="ri-information-line me-2 text-primary"></i>نظرة عامة
                            @else
                                <i class="ri-information-line me-2 text-primary"></i>Project Overview
                            @endif
                        </h2>
                        
                        @if($project->short_description)
                            <div class="lead mb-4">
                                {{ $project->short_description }}
                            </div>
                        @endif
                        
                        @if($project->description || $project->description_ar)
                            <div class="project-description">
                                {!! nl2br(e(app()->getLocale() == 'ar' ? ($project->description_ar ?: $project->description) : $project->description)) !!}
                            </div>
                        @endif
                        
                        <!-- Key Facts Grid -->
                        <div class="row g-4 mt-4">
                            @if($project->min_bedrooms || $project->max_bedrooms)
                                <div class="col-md-3 col-6">
                                    <div class="fact-card text-center p-3 border rounded-3">
                                        <div class="fact-icon bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="ri-hotel-bed-line text-primary fs-4"></i>
                                        </div>
                                        <h4 class="mb-1">
                                            @if($project->min_bedrooms && $project->max_bedrooms)
                                                {{ $project->min_bedrooms }} 
                                            @elseif($project->min_bedrooms)
                                                {{ $project->min_bedrooms }}+
                                            @else
                                                {{ $project->max_bedrooms }}
                                            @endif
                                        </h4>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                غرف نوم
                                            @else
                                                Bedrooms
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($project->delivery_year)
                                <div class="col-md-3 col-6">
                                    <div class="fact-card text-center p-3 border rounded-3">
                                        <div class="fact-icon bg-warning bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="ri-calendar-2-line text-warning fs-4"></i>
                                        </div>
                                        <h4 class="mb-1">{{ $project->delivery_year }}</h4>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                التسليم
                                            @else
                                                Delivery
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($project->installments_up_to)
                                <div class="col-md-3 col-6">
                                    <div class="fact-card text-center p-3 border rounded-3">
                                        <div class="fact-icon bg-info bg-opacity-10 rounded-circle p-3 d-inline-flex mb-2">
                                            <i class="ri-time-line text-info fs-4"></i>
                                        </div>
                                        <h4 class="mb-1">{{ $project->installments_up_to }}</h4>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                سنوات تقسيط
                                            @else
                                                Years Installment
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                    
                    <!-- Gallery Section -->
                    @if($project->images->count())
                        <section id="gallery" class="mb-5 pt-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="fw-bold mb-0">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="ri-image-line me-2 text-primary"></i>معرض الصور
                                    @else
                                        <i class="ri-image-line me-2 text-primary"></i>Project Gallery
                                    @endif
                                </h2>
                                <button class="btn btn-outline-primary view-all-photos" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <i class="ri-grid-line me-2"></i>
                                    @if(app()->getLocale() == 'ar')
                                        عرض جميع الصور ({{ $project->images->count() }})
                                    @else
                                        View All Photos ({{ $project->images->count() }})
                                    @endif
                                </button>
                            </div>
                            
                            <div class="row g-3">
                                @php
                                    $sortedImages = $project->images->sortBy('sort_order')->values();
                                @endphp
                                
                                <!-- Main Image -->
                                @if($sortedImages->count() > 0)
                                    <div class="col-12 mb-3">
                                        <div class="gallery-main position-relative rounded-3 overflow-hidden">
                                            <img src="{{ asset('storage/' . $sortedImages[0]->image) }}" 
                                                 alt="{{ $project->name }}" 
                                                 class="w-100 rounded-3"
                                                 style="height: 400px; object-fit: cover;">
                                            <div class="position-absolute top-3 end-3">
                                                <span class="badge bg-white text-dark px-3 py-2">
                                                    @if(app()->getLocale() == 'ar')
                                                        الصورة الرئيسية
                                                    @else
                                                        Main Image
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Thumbnail Grid -->
                                @if($sortedImages->count() > 1)
                                    <div class="col-12">
                                        <div class="row g-3">
                                            @foreach($sortedImages->slice(1, 4) as $index => $image)
                                                <div class="col-md-3 col-6">
                                                    <div class="gallery-thumb position-relative rounded-3 overflow-hidden">
                                                        <img src="{{ asset('storage/' . $image->image) }}" 
                                                             alt="Gallery Image {{ $index + 2 }}" 
                                                             class="w-100"
                                                             style="height: 180px; object-fit: cover; cursor: pointer;">
                                                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-opacity">
                                                            <i class="ri-zoom-in-line  fs-3"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @if($sortedImages->count() > 5)
                                                <div class="col-md-3 col-6">
                                                    <div class="gallery-thumb position-relative rounded-3 overflow-hidden bg-primary"
                                                         data-bs-toggle="modal" data-bs-target="#galleryModal">
                                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center "
                                                             style="height: 180px; cursor: pointer;"
                                                             onclick="openGalleryModal(5)">
                                                            <div class="display-4 fw-bold">{{ $sortedImages->count() - 4 }}+</div>
                                                            <div>
                                                                @if(app()->getLocale() == 'ar')
                                                                    صور أكثر
                                                                @else
                                                                    More Photos
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endif
                    
                    <!-- Location Section -->
                    <section id="location" class="mb-5 pt-4">
                        <h2 class="mb-4 fw-bold">
                            @if(app()->getLocale() == 'ar')
                                <i class="ri-map-pin-line me-2 text-primary"></i>الموقع
                            @else
                                <i class="ri-map-pin-line me-2 text-primary"></i>Location & Map
                            @endif
                        </h2>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="location-details">
                                    <h5 class="mb-3">
                                        @if(app()->getLocale() == 'ar')
                                            تفاصيل الموقع
                                        @else
                                            Location Details
                                        @endif
                                    </h5>
                                    
                                    <ul class="list-unstyled">
                                        @if($project->city || $project->city_ar)
                                            <li class="mb-2 d-flex align-items-start">
                                                <i class="ri-map-pin-2-line text-primary me-2 mt-1"></i>
                                                <div>
                                                    <strong>
                                                        @if(app()->getLocale() == 'ar')
                                                            المدينة:
                                                        @else
                                                            City:
                                                        @endif
                                                    </strong>
                                                    {{ app()->getLocale() == 'ar' ? ($project->city_ar ?: $project->city) : $project->city }}
                                                </div>
                                            </li>
                                        @endif
                                        
                                        @if($project->location_text)
                                            <li class="mb-2 d-flex align-items-start">
                                                <i class="ri-road-map-line text-primary me-2 mt-1"></i>
                                                <div>
                                                    <strong>
                                                        @if(app()->getLocale() == 'ar')
                                                            المنطقة:
                                                        @else
                                                            Area:
                                                        @endif
                                                    </strong>
                                                    {{ $project->location_text }}
                                                </div>
                                            </li>
                                        @endif
                                        
                                        @if($project->developer)
                                            <li class="mb-2 d-flex align-items-start">
                                                <i class="ri-building-line text-primary me-2 mt-1"></i>
                                                <div>
                                                    <strong>
                                                        @if(app()->getLocale() == 'ar')
                                                            المطور:
                                                        @else
                                                            Developer:
                                                        @endif
                                                    </strong>
                                                    {{ $project->developer }}
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                    
                                    <!-- Nearby Places -->
                                    <div class="mt-4">
                                        <h6 class="mb-3">
                                            @if(app()->getLocale() == 'ar')
                                                أماكن قريبة
                                            @else
                                                Nearby Places
                                            @endif
                                        </h6>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center bg-light rounded p-2">
                                                    <i class="ri-shopping-cart-line text-success me-2"></i>
                                                    <span class="small">
                                                        @if(app()->getLocale() == 'ar')
                                                            مولات
                                                        @else
                                                            Malls
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center bg-light rounded p-2">
                                                    <i class="ri-hospital-line text-danger me-2"></i>
                                                    <span class="small">
                                                        @if(app()->getLocale() == 'ar')
                                                            مستشفيات
                                                        @else
                                                            Hospitals
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center bg-light rounded p-2">
                                                    <i class="ri-school-line text-info me-2"></i>
                                                    <span class="small">
                                                        @if(app()->getLocale() == 'ar')
                                                            مدارس
                                                        @else
                                                            Schools
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center bg-light rounded p-2">
                                                    <i class="ri-restaurant-line text-warning me-2"></i>
                                                    <span class="small">
                                                        @if(app()->getLocale() == 'ar')
                                                            مطاعم
                                                        @else
                                                            Restaurants
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="map-container rounded-3 overflow-hidden border" style="height: 300px;">
                                    <!-- Static Map or Google Maps Integration -->
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <i class="ri-map-2-line display-4 text-muted mb-3"></i>
                                            <p class="text-muted">
                                                @if(app()->getLocale() == 'ar')
                                                    خريطة الموقع التفاعلية
                                                @else
                                                    Interactive Location Map
                                                @endif
                                            </p>
                                            <button class="btn btn-outline-primary btn-sm">
                                                @if(app()->getLocale() == 'ar')
                                                    عرض على خرائط جوجل
                                                @else
                                                    View on Google Maps
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Features Section -->
                    <section id="features" class="mb-5 pt-4">
                        <h2 class="mb-4 fw-bold">
                            @if(app()->getLocale() == 'ar')
                                <i class="ri-star-line me-2 text-primary"></i>مميزات المشروع
                            @else
                                <i class="ri-star-line me-2 text-primary"></i>Project Features
                            @endif
                        </h2>
                        
                        <div class="row g-4">
                            @if($project->type === 'compound')
                                <!-- Compound Features -->
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
<i class="ri-water-flash-line text-success fs-3"></i>

                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                حمام سباحة
                                            @else
                                                Swimming Pools
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                مسابح أوليمبية وإسبا
                                            @else
                                                Olympic pools & spa facilities
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-tree-line text-success fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                مساحات خضراء
                                            @else
                                                Green Spaces
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                حدائق ومسطحات خضراء واسعة
                                            @else
                                                Extensive gardens & landscapes
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-info bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-shield-check-line text-info fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                أمن 24/7
                                            @else
                                                24/7 Security
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                أنظمة أمنية متطورة
                                            @else
                                                Advanced security systems
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-warning bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-basketball-line text-warning fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                مرافق رياضية
                                            @else
                                                Sports Facilities
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                جيم وملاعب رياضية
                                            @else
                                                Gym & sports courts
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-danger bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-shopping-cart-2-line text-danger fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                مركز تسوق
                                            @else
                                                Shopping Center
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                مول تجاري وخدمات
                                            @else
                                                Commercial mall & services
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-purple bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-car-line text-purple fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                مواقف سيارات
                                            @else
                                                Car Parking
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                مواقف مظللة وكافية
                                            @else
                                                Covered & sufficient parking
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @else
                                <!-- Residential Project Features -->
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-home-gear-line text-primary fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                تشطبات فاخرة
                                            @else
                                                Premium Finishing
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                تشطبات سوبر لوكس
                                            @else
                                                Super lux finishing
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-success bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-landscape-line text-success fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                إطلالات مميزة
                                            @else
                                                Premium Views
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                إطلالات على الحدائق
                                            @else
                                                Garden views available
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-6">
                                    <div class="feature-item text-center p-3">
                                        <div class="feature-icon bg-info bg-opacity-10 rounded-circle p-3 d-inline-flex mb-3">
                                            <i class="ri-shield-star-line text-info fs-3"></i>
                                        </div>
                                        <h6 class="mb-2">
                                            @if(app()->getLocale() == 'ar')
                                                جودة بناء
                                            @else
                                                Build Quality
                                            @endif
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                مواد بناء عالية الجودة
                                            @else
                                                High-quality construction
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                    
              
                </div>
                
                <!-- Right Column (Sidebar) -->
                <div class="col-lg-4">
                    <!-- Developer Info -->
                    @if($project->developer)
                        <div class="developer-card mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-3">
                                        @if(app()->getLocale() == 'ar')
                                            <i class="ri-building-line me-2"></i>المطور العقاري
                                        @else
                                            <i class="ri-building-line me-2"></i>Developer
                                        @endif
                                    </h5>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="developer-logo bg-light rounded-circle p-3 me-3">
                                            <i class="ri-building-4-line fs-3 text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $project->developer }}</h6>
                                            <small class="text-muted">
                                                @if(app()->getLocale() == 'ar')
                                                    مطور معتمد
                                                @else
                                                    Certified Developer
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <p class="small text-muted mb-3">
                                        @if(app()->getLocale() == 'ar')
                                            أحد المطورين الرائدين في السوق العقاري
                                        @else
                                            One of the leading developers in the real estate market
                                        @endif
                                    </p>
                                    <button class="btn btn-outline-primary w-100">
                                        <i class="ri-building-2-line me-2"></i>
                                        @if(app()->getLocale() == 'ar')
                                            جميع مشاريع المطور
                                        @else
                                            All Developer Projects
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Contact Form -->
                    <div class="contact-card mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="ri-customer-service-line me-2"></i>استفسار سريع
                                    @else
                                        <i class="ri-customer-service-line me-2"></i>Quick Inquiry
                                    @endif
                                </h5>
                                <p class="small text-muted mb-3">
                                    @if(app()->getLocale() == 'ar')
                                        اترك بياناتك وسنتواصل معك خلال دقائق
                                    @else
                                        Leave your details and we'll contact you within minutes
                                    @endif
                                </p>
                                
                                <form id="quickInquiryForm" method="POST" action="{{ route('contact.send') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="@if(app()->getLocale() == 'ar') الاسم الكامل @else Full Name @endif" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" name="phone" class="form-control" placeholder="@if(app()->getLocale() == 'ar') رقم الهاتف @else Phone Number @endif" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="@if(app()->getLocale() == 'ar') البريد الإلكتروني @else Email Address @endif" required>
                                    </div>
                                    <div class="mb-3">
                                        <select name="inquiry_type" class="form-select">
                                            <option selected>
                                                @if(app()->getLocale() == 'ar')
                                                    نوع الاستفسار
                                                @else
                                                    Inquiry Type
                                                @endif
                                            </option>
                                            <option value="price">@if(app()->getLocale() == 'ar') الأسعار @else Prices @endif</option>
                                            <option value="installment">@if(app()->getLocale() == 'ar') التقسيط @else Installments @endif</option>
                                            <option value="unit">@if(app()->getLocale() == 'ar') وحدة محددة @else Specific Unit @endif</option>
                                            <option value="visit">@if(app()->getLocale() == 'ar') زيارة موقع @else Site Visit @endif</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="subject" id="quickInquirySubject">
                                    <input type="hidden" name="message" id="quickInquiryMessage">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-send-plane-line me-2"></i>
                                        @if(app()->getLocale() == 'ar')
                                            إرسال الاستفسار
                                        @else
                                            Send Inquiry
                                        @endif
                                    </button>
                                </form>
                                
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="ri-shield-check-line text-success me-1"></i>
                                        @if(app()->getLocale() == 'ar')
                                            بياناتك محمية ولا نشاركها مع أحد
                                        @else
                                            Your data is protected & never shared
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="similar-projects">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="ri-building-2-line me-2"></i>مشاريع مشابهة
                                    @else
                                        <i class="ri-building-2-line me-2"></i>Similar Projects
                                    @endif
                                </h5>
                                
                                <div class="similar-projects-list">
                                    @if($similarProjects->count())
                                        @foreach($similarProjects as $similar)
                                            @php
                                                $mainImage = optional($similar->images->firstWhere('is_main', true))->image
                                                    ?? $similar->main_image
                                                    ?? optional($similar->images->first())->image;
                                                $similarName = app()->getLocale() == 'ar'
                                                    ? ($similar->name_ar ?: $similar->name)
                                                    : $similar->name;
                                                $similarCity = app()->getLocale() == 'ar'
                                                    ? ($similar->city_ar ?: $similar->city)
                                                    : $similar->city;
                                                $currency = $similar->price_currency ?: 'EGP';
                                            @endphp
                                            <div class="similar-project-item d-flex mb-3">
                                                <div class="flex-shrink-0">
                                                    <a href="{{ route('projects.show', $similar->slug ?: $similar->id) }}">
                                                        <img src="{{ $mainImage ? asset('storage/' . $mainImage) : asset('assets/images/properties/properties2.jpg') }}" 
                                                             alt="{{ $similarName }}" 
                                                             class="rounded-2"
                                                             style="width: 80px; height: 80px; object-fit: cover;">
                                                    </a>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">
                                                        <a href="{{ route('projects.show', $similar->slug ?: $similar->id) }}" class="text-decoration-none text-dark">
                                                            {{ $similarName }}
                                                        </a>
                                                    </h6>
                                                    <div class="d-flex align-items-center text-muted small mb-1">
                                                        <i class="ri-map-pin-line me-1"></i>
                                                        <span>
                                                            {{ $similarCity }}
                                                            @if($similar->location_text)
                                                                , {{ $similar->location_text }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if($similar->starting_price)
                                                        <div class="fw-bold text-primary">
                                                            {{ $currency }} {{ number_format($similar->starting_price, 0) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">
                                            @if(app()->getLocale() == 'ar')
                                                لا توجد مشاريع مشابهة حالياً.
                                            @else
                                                No similar projects available at the moment.
                                            @endif
                                        </p>
                                    @endif
                                    
                                    <div class="text-center mt-3">
                                        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="ri-search-line me-2"></i>
                                            @if(app()->getLocale() == 'ar')
                                                اكتشف المزيد
                                            @else
                                                Discover More
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    @if($project->images->count())
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @if(app()->getLocale() == 'ar')
                                معرض {{ $project->name }}
                            @else
                                {{ $project->name }} Gallery
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @foreach($project->images as $image)
                                <div class="col-md-3 col-6">
                                    <a href="{{ asset('storage/' . $image->image) }}" data-fslightbox="gallery">
                                        <img src="{{ asset('storage/' . $image->image) }}" 
                                             alt="Gallery Image" 
                                             class="img-fluid rounded-2"
                                             style="height: 180px; object-fit: cover;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
/* Hero Section */
.project-hero-section {
    position: relative;
    background: linear-gradient(135deg, #0b4b8f 0%, #0d6efd 100%);
    overflow: hidden;
}

.hero-slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.hero-slide {
    width: 100%;
    height: 100%;
    opacity: 0;
    animation: slideFade 15s infinite;
}

.hero-slide:nth-child(2) {
    animation-delay: 5s;
}

.hero-slide:nth-child(3) {
    animation-delay: 10s;
}

@keyframes slideFade {
    0%, 30% { opacity: 0; }
    10%, 20% { opacity: 1; }
    40%, 100% { opacity: 0; }
}

.hero-content {
    position: relative;
    z-index: 2;
}

.backdrop-blur {
    backdrop-filter: blur(10px);
}

/* Navigation */
.project-navigation {
    border-bottom: 1px solid #e5e7eb;
    z-index: 1020;
}

.project-nav-link {
    padding: 1rem 1.5rem;
    color: #6b7280;
    text-decoration: none;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    font-weight: 500;
}

.project-nav-link:hover {
    color: #0b4b8f;
}

.project-nav-link.active {
    color: #0b4b8f;
    border-bottom-color: #0b4b8f;
    background-color: #f8fafc;
}

/* Gallery Styles */
.gallery-thumb:hover .gallery-overlay {
    opacity: 1;
}

.transition-opacity {
    transition: opacity 0.3s ease;
}

/* Feature Cards */
.feature-item {
    transition: transform 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
}

/* Payment Plan Cards */
.payment-plan-card {
    transition: all 0.3s ease;
}

.payment-plan-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

/* Developer Logo */
.developer-logo {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Form Styling */
.form-control, .form-select {
    border-radius: 10px;
    border-color: #e5e7eb;
    padding: 0.75rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #0b4b8f;
    box-shadow: 0 0 0 3px rgba(11, 75, 143, 0.1);
}

/* Scroll Animation */
section {
    scroll-margin-top: 120px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .project-hero-section {
        padding-top: 100px;
    }
    
    .hero-content {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .project-navigation {
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .project-nav-link {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
    
    .display-6 {
        font-size: 1.75rem;
    }
}

/* Animations */
.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

.animate-slide-up {
    animation: slideUp 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0;
        transform: translateY(30px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom Badges */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

.bg-purple {
    background-color: #6f42c1 !important;
}

.text-purple {
    color: #6f42c1 !important;
}

/* Price Card */
.price-card {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Map Container */
.map-container {
    transition: all 0.3s ease;
}

.map-container:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Similar Projects */
.similar-project-item {
    transition: all 0.3s ease;
    border-radius: 8px;
    padding: 8px;
}

.similar-project-item:hover {
    background-color: #f8f9fa;
}

/* Text Colors */
.text-white-80 {
    color: #ffffff !important;
}

.text-white-60 {
    color: rgba(255, 255, 255, 0.6) !important;
}

/* RTL Support */
[dir="rtl"] .me-2 {
    margin-right: 0 !important;
    margin-left: 0.5rem !important;
}

[dir="rtl"] .ms-2 {
    margin-left: 0 !important;
    margin-right: 0.5rem !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Navigation Scroll
    const navLinks = document.querySelectorAll('.project-nav-link');
    const sections = document.querySelectorAll('section');
    
    function updateActiveNav() {
        let scrollPosition = window.scrollY + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
    
    // Smooth scrolling for navigation
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    window.addEventListener('scroll', updateActiveNav);
    
    // Gallery Modal
    const galleryThumbs = document.querySelectorAll('.gallery-thumb img');
    galleryThumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
            modal.show();
        });
    });
    
    // Quick Inquiry Form
    const inquiryForm = document.getElementById('quickInquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function() {
            const nameInput = this.querySelector('input[name="name"]');
            const phoneInput = this.querySelector('input[name="phone"]');
            const emailInput = this.querySelector('input[name="email"]');
            const typeSelect = this.querySelector('select[name="inquiry_type"]');
            const subjectInput = document.getElementById('quickInquirySubject');
            const messageInput = document.getElementById('quickInquiryMessage');

            let typeText = '';
            if (typeSelect && typeSelect.value) {
                const selectedOption = typeSelect.options[typeSelect.selectedIndex];
                if (selectedOption) {
                    typeText = selectedOption.textContent.trim();
                }
            }

            @if(app()->getLocale() == 'ar')
                let baseSubject = 'استفسار سريع عن مشروع {{ $project->name }}';
                let baseMessage = 'العميل ' + (nameInput ? nameInput.value : '') + ' أرسل استفسار سريع عن مشروع {{ $project->name }}.';
                if (typeText) {
                    baseMessage += ' نوع الاستفسار: ' + typeText + '.';
                }
                if (phoneInput && phoneInput.value) {
                    baseMessage += ' رقم الهاتف: ' + phoneInput.value + '.';
                }
                if (emailInput && emailInput.value) {
                    baseMessage += ' البريد الإلكتروني: ' + emailInput.value + '.';
                }
            @else
                let baseSubject = 'Quick inquiry about project {{ $project->name }}';
                let baseMessage = 'Customer ' + (nameInput ? nameInput.value : '') + ' sent a quick inquiry about project {{ $project->name }}.';
                if (typeText) {
                    baseMessage += ' Inquiry type: ' + typeText + '.';
                }
                if (phoneInput && phoneInput.value) {
                    baseMessage += ' Phone: ' + phoneInput.value + '.';
                }
                if (emailInput && emailInput.value) {
                    baseMessage += ' Email: ' + emailInput.value + '.';
                }
            @endif

            if (subjectInput) {
                subjectInput.value = baseSubject;
            }
            if (messageInput) {
                messageInput.value = baseMessage;
            }
        });
    }
    
    // Initialize animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);
    
    // Observe all sections for animation
    sections.forEach(section => {
        observer.observe(section);
    });
});
</script>
@endpush
