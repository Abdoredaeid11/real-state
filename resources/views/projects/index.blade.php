@extends('layouts.master')

@section('content')
    <!-- Hero Section مع تحسينات -->
    <div class="compound-search-hero pt-120 pb-120 position-relative">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(11, 75, 143, 0.85), rgba(5, 45, 90, 0.9)), url('https://images.pexels.com/photos/1642125/pexels-photo-1642125.jpeg?_gl=1*tb2rey*_ga*MTkwNDE5Nzg4OC4xNzY3NjIyMzM5*_ga_8JE65Q40S6*czE3NjgyMTE5MDQkbzQkZzEkdDE3NjgyMTE5MjEkajQzJGwwJGgw') center center / cover no-repeat;"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="text-center mb-5 animate-fade-in">
                        @if (app()->getLocale() == 'ar')
                            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -0.5px;">ابحث عن مشروعك العقاري المثالي</h1>
                            <p class="fs-5 text-white-50 mb-0">استكشف آلاف المشاريع العقارية والكمبوندات المتميزة في أفضل المواقع</p>
                        @else
                            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -0.5px;">Find Your Perfect Real Estate Project</h1>
                            <p class="fs-5 text-white-50 mb-0">Explore thousands of premium compounds and real estate projects in prime locations</p>
                        @endif
                    </div>
                    
                    <div class="compound-search-box p-4 p-lg-5 animate-slide-up" 
                         style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 25px 60px rgba(15, 25, 54, 0.15);">
                        
                        <!-- Tabs Navigation -->
                        <div class="mb-4">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill" id="projects_search_tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active d-flex align-items-center justify-content-center gap-2" 
                                                id="projects_tab_compounds" 
                                                data-bs-toggle="pill" 
                                                data-bs-target="#projects_tab_compounds_content" 
                                                type="button" 
                                                role="tab">
                                            <i class="ri-building-4-line fs-5"></i>
                                            @if(app()->getLocale() == 'ar')
                                                <span>الكـــمــبــونــدات</span>
                                            @else
                                                <span>Compounds</span>
                                            @endif
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link d-flex align-items-center justify-content-center gap-2" 
                                                id="projects_tab_properties" 
                                                data-bs-toggle="pill" 
                                                data-bs-target="#projects_tab_properties_content" 
                                                type="button" 
                                                role="tab">
                                            <i class="ri-home-4-line fs-5"></i>
                                            @if(app()->getLocale() == 'ar')
                                                <span>الـــوحدات الــســكنــيــة</span>
                                            @else
                                                <span>Residential Units</span>
                                            @endif
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Tabs Content -->
                        <div class="tab-content pt-3" id="projects_search_tabs_content">
                            <!-- Compounds Tab -->
                            <div class="tab-pane fade show active" id="projects_tab_compounds_content" role="tabpanel">
                                <form class="compound-search-form" method="GET" action="{{ route('projects.index') }}">
                                    <input type="hidden" name="type" value="compound">
                                    <div class="row g-3">
                                        <div class="col-lg-10 position-relative">
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="ri-search-2-line text-muted"></i>
                                                </span>
                                                <input type="text" 
                                                       name="q"
                                                       class="form-control border-start-0 compound-search-input"
                                                       placeholder="{{ app()->getLocale() == 'ar' ? 'ابحث عن كمبوند، منطقة، أو اسم المطور...' : 'Search for compound, area, or developer name...' }}"
                                                       autocomplete="off"
                                                       style="border-radius: 0 12px 12px 0;">
                                            </div>
                                            <div class="list-group position-absolute w-100 compound-search-suggestions"
                                                 style="z-index: 1050; max-height: 300px; overflow-y: auto; display: none; border-radius: 0 0 12px 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-lg w-100 h-100">
                                                @if(app()->getLocale() == 'ar')
                                                    <i class="ri-search-2-line me-2"></i>بحث
                                                @else
                                                    <i class="ri-search-2-line me-2"></i>Search
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Advanced Filters (Collapsible) -->
                                    <div class="mt-4">
                                        <a class="text-decoration-none d-inline-flex align-items-center" 
                                           data-bs-toggle="collapse" 
                                           href="#advancedFilters" 
                                           role="button">
                                            <i class="ri-filter-3-line me-2"></i>
                                            @if(app()->getLocale() == 'ar')
                                                <span>فلتر متقدم</span>
                                            @else
                                                <span>Advanced Filters</span>
                                            @endif
                                            <i class="ri-arrow-down-s-line ms-2"></i>
                                        </a>
                                        <div class="collapse mt-3" id="advancedFilters">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label class="form-label small text-muted mb-1">
                                                        @if(app()->getLocale() == 'ar') الموقع @else Location @endif
                                                    </label>
                                                    <select class="form-select" name="location">
                                                        <option value="">
                                                            @if(app()->getLocale() == 'ar') اختر الموقع @else Select Location @endif
                                                        </option>
                                                        @isset($locations)
                                                            @foreach($locations as $location)
                                                                <option value="{{ $location }}" {{ request('location') === $location ? 'selected' : '' }}>
                                                                    {{ $location }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small text-muted mb-1">
                                                        @if(app()->getLocale() == 'ar') السعر @else Price @endif
                                                    </label>
                                                    <select class="form-select" name="price_range">
                                                        <option value="">
                                                            @if(app()->getLocale() == 'ar') نطاق السعر @else Price Range @endif
                                                        </option>
                                                        <option value="0-1000000" {{ request('price_range') === '0-1000000' ? 'selected' : '' }}>
                                                            @if(app()->getLocale() == 'ar') حتى 1,000,000 @else Up to 1,000,000 @endif
                                                        </option>
                                                        <option value="1000000-3000000" {{ request('price_range') === '1000000-3000000' ? 'selected' : '' }}>
                                                            @if(app()->getLocale() == 'ar') 1,000,000 - 3,000,000 @else 1,000,000 - 3,000,000 @endif
                                                        </option>
                                                        <option value="3000000-0" {{ request('price_range') === '3000000-0' ? 'selected' : '' }}>
                                                            @if(app()->getLocale() == 'ar') أكثر من 3,000,000 @else Above 3,000,000 @endif
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label small text-muted mb-1">
                                                        @if(app()->getLocale() == 'ar') سنة التسليم @else Delivery @endif
                                                    </label>
                                                    <select class="form-select" name="delivery_year">
                                                        <option value="">
                                                            @if(app()->getLocale() == 'ar') سنة التسليم @else Delivery Year @endif
                                                        </option>
                                                        @isset($deliveryYears)
                                                            @foreach($deliveryYears as $year)
                                                                <option value="{{ $year }}" {{ (string) request('delivery_year') === (string) $year ? 'selected' : '' }}>
                                                                    {{ $year }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Properties Tab -->
                            <div class="tab-pane fade" id="projects_tab_properties_content" role="tabpanel">
                                <form class="compound-search-form" method="GET" action="{{ route('projects.index') }}">
                                    <input type="hidden" name="type" value="property">
                                    <div class="row g-3">
                                        <div class="col-lg-10 position-relative">
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="ri-search-2-line text-muted"></i>
                                                </span>
                                                <input type="text" 
                                                       name="q"
                                                       class="form-control border-start-0 compound-search-input"
                                                       placeholder="{{ app()->getLocale() == 'ar' ? 'ابحث عن وحدة سكنية، منطقة، أو اسم المشروع...' : 'Search for residential unit, area, or project name...' }}"
                                                       autocomplete="off"
                                                       style="border-radius: 0 12px 12px 0;">
                                            </div>
                                            <div class="list-group position-absolute w-100 compound-search-suggestions"
                                                 style="z-index: 1050; max-height: 300px; overflow-y: auto; display: none; border-radius: 0 0 12px 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-lg w-100 h-100">
                                                @if(app()->getLocale() == 'ar')
                                                    <i class="ri-search-2-line me-2"></i>بحث
                                                @else
                                                    <i class="ri-search-2-line me-2"></i>Search
                                                @endif
                                            </button>
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

    <!-- Statistics Bar -->
    <div class="statistics-bar py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="fw-bold text-primary mb-1">1,200+</h3>
                        <p class="text-muted small mb-0">@if(app()->getLocale() == 'ar') مشروع @else Projects @endif</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="fw-bold text-primary mb-1">85+</h3>
                        <p class="text-muted small mb-0">@if(app()->getLocale() == 'ar') مطور @else Developers @endif</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="fw-bold text-primary mb-1">40+</h3>
                        <p class="text-muted small mb-0">@if(app()->getLocale() == 'ar') منطقة @else Areas @endif</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center">
                        <h3 class="fw-bold text-primary mb-1">15+</h3>
                        <p class="text-muted small mb-0">@if(app()->getLocale() == 'ar') سنة خبرة @else Years Experience @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="projects-section" style="padding-top: 70px;padding-bottom: 70px">
        <div class="container">
            <!-- Header with Filters -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
                <div>
                    <h2 class="fw-bold mb-2">
                        @if(app()->getLocale() == 'ar')
                            المشــاريــع الــعــقــاريــة
                        @else
                            Featured Real Estate Projects
                        @endif
                    </h2>
                    <p class="text-muted mb-0">
                        @if(app()->getLocale() == 'ar')
                            استعرض أفضل المشاريع العقارية المميزة
                        @else
                            Browse our curated selection of premium real estate projects
                        @endif
                    </p>
                </div>
                
                <div class="d-flex gap-3 mt-3 mt-md-0">
                    <div class="dropdown">
                        @php
                            $sortParams = request()->all();
                            unset($sortParams['page']);
                        @endphp
                        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" 
                                type="button" 
                                data-bs-toggle="dropdown">
                            <i class="ri-filter-3-line me-2"></i>
                            @if(app()->getLocale() == 'ar')
                                <span>فرز حسب</span>
                            @else
                                <span>Sort by</span>
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('projects.index', array_merge($sortParams, ['sort' => 'newest'])) }}">
                                    @if(app()->getLocale() == 'ar') الأحدث @else Newest @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('projects.index', array_merge($sortParams, ['sort' => 'price_asc'])) }}">
                                    @if(app()->getLocale() == 'ar') الأدنى سعراً @else Price (Low to High) @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('projects.index', array_merge($sortParams, ['sort' => 'price_desc'])) }}">
                                    @if(app()->getLocale() == 'ar') الأعلى سعراً @else Price (High to Low) @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('projects.index', array_merge($sortParams, ['sort' => 'delivery_nearest'])) }}">
                                    @if(app()->getLocale() == 'ar') الأقرب تسليم @else Nearest Delivery @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!--<div class="btn-group" role="group">-->
                    <!--    <input type="radio" class="btn-check" name="viewMode" id="gridView" autocomplete="off" checked>-->
                    <!--    <label class="btn btn-outline-secondary" for="gridView">-->
                    <!--        <i class="ri-grid-line"></i>-->
                    <!--    </label>-->
                        
                    <!--    <input type="radio" class="btn-check" name="viewMode" id="listView" autocomplete="off">-->
                    <!--    <label class="btn btn-outline-secondary" for="listView">-->
                    <!--        <i class="ri-list-check"></i>-->
                    <!--    </label>-->
                    <!--</div>-->
                </div>
            </div>
            
            <!-- Projects Grid -->
            <div class="row g-4 project-list-wrapper">
                @forelse ($projects as $project)
                    @php
                        $mainImage = $project->images->where('is_main', true)->sortBy('sort_order')->first();
                        if (!$mainImage && $project->images->count()) {
                            $mainImage = $project->images->sortBy('sort_order')->first();
                        }
                    @endphp
                    
                    <div class="col-xl-4 col-lg-6">
                        <div class="project-card h-100 animate-fade-up" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <div class="card border-0 shadow-lg h-100 overflow-hidden" 
                                 style="border-radius: 16px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <!-- Image with Badge -->
                                <div class="position-relative overflow-hidden" style="height: 240px;">
                                    <a href="{{ route('projects.show', $project->slug ?: $project->id) }}" class="text-decoration-none">
                                        @if($mainImage)
                                            <img src="{{ asset('storage/' . $mainImage->image) }}" 
                                                 class="card-img-top w-100 h-100"
                                                 alt="{{ $project->name }}"
                                                 style="object-fit: cover; transition: transform 0.5s ease;">
                                        @else
                                            <img src="{{ asset('assets/images/properties/properties1.jpg') }}" 
                                                 class="card-img-top w-100 h-100"
                                                 alt="image"
                                                 style="object-fit: cover; transition: transform 0.5s ease;">
                                        @endif
                                        
                                        <!-- Overlay Gradient -->
                                        <div class="position-absolute top-0 start-0 w-100 h-100"
                                             style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 40%, transparent 60%);"></div>
                                        
                                        <!-- Type Badge -->
                                        <div class="position-absolute top-3 start-3">
                                            <span class="badge bg-white text-dark px-3 py-2 fw-medium"
                                                  style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                                @if(app()->getLocale() == 'ar')
                                                    @if($project->type === 'compound')
                                                        <i class="ri-building-4-line me-1"></i> كمبوند
                                                    @else
                                                        <i class="ri-home-4-line me-1"></i> مشروع
                                                    @endif
                                                @else
                                                    <i class="ri-building-4-line me-1"></i> {{ ucfirst($project->type) }}
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <!-- Favorite Button -->
                                        <button class="btn btn-light btn-sm position-absolute top-3 end-3 rounded-circle"
                                                style="width: 36px; height: 36px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                            <i class="ri-heart-3-line"></i>
                                        </button>
                                    </a>
                                </div>
                                
                                <!-- Card Body -->
                                <div class="card-body p-4">
                                    <!-- Title and Location -->
                                    <div class="mb-3">
                                        <h3 class="h5 fw-bold mb-2">
                                            <a href="{{ route('projects.show', $project->slug ?: $project->id) }}" 
                                               class="text-decoration-none text-dark">
                                                {{ app()->getLocale() == 'ar' ? ($project->name_ar ?: $project->name) : $project->name }}
                                            </a>
                                        </h3>
                                        <div class="d-flex align-items-center text-muted mb-2">
                                            <i class="ri-map-pin-2-line me-2"></i>
                                            <span class="small">
                                                @if($project->city || $project->city_ar)
                                                    {{ app()->getLocale() == 'ar' ? ($project->city_ar ?: $project->city) : $project->city }}
                                                @endif
                                                @if($project->developer)
                                                    • {{ $project->developer }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Features -->
                                    <div class="mb-4">
                                        <div class="row g-2">
                                            @if($project->min_bedrooms || $project->max_bedrooms)
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                            <i class="ri-hotel-bed-line text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <div class="small text-muted">
                                                                @if(app()->getLocale() == 'ar') غرف @else Bedrooms @endif
                                                            </div>
                                                            <div class="fw-medium">
                                                                @if($project->min_bedrooms && $project->max_bedrooms)
                                                                    {{ $project->min_bedrooms }} 
                                                                @elseif($project->min_bedrooms)
                                                                    From {{ $project->min_bedrooms }}
                                                                @else
                                                                    Up to {{ $project->max_bedrooms }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($project->delivery_year)
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success bg-opacity-10 rounded p-2 me-2">
                                                            <i class="ri-calendar-2-line text-success"></i>
                                                        </div>
                                                        <div>
                                                            <div class="small text-muted">
                                                                @if(app()->getLocale() == 'ar') التسليم @else Delivery @endif
                                                            </div>
                                                            <div class="fw-medium">{{ $project->delivery_year }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($project->installments_up_to)
                                                <div class="col-12 mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-info bg-opacity-10 rounded p-2 me-2">
                                                            <i class="ri-time-line text-info"></i>
                                                        </div>
                                                        <div>
                                                            <div class="small text-muted">
                                                                @if(app()->getLocale() == 'ar') أنظمة السداد @else Installments @endif
                                                            </div>
                                                            <div class="fw-medium">
                                                                @if(app()->getLocale() == 'ar')
                                                                    حتى {{ $project->installments_up_to }} سنة
                                                                @else
                                                                    Up to {{ $project->installments_up_to }} years
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Price and CTA -->
                                    <div class="border-top pt-3 mt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="small text-muted">
                                                    @if(app()->getLocale() == 'ar')
                                                        يبدأ من
                                                    @else
                                                        Starting from
                                                    @endif
                                                </div>
                                                <div class="h4 fw-bold text-primary mb-0">
                                                    {{ $project->price_currency ?: 'EGP' }}
                                                    {{ number_format($project->starting_price, 0) }}
                                                </div>
                                            </div>
                                            <a href="{{ route('projects.show', $project->slug ?: $project->id) }}" 
                                               class="btn btn-primary px-4">
                                                @if(app()->getLocale() == 'ar')
                                                    التفاصيل
                                                @else
                                                    Details
                                                @endif
                                                <i class="ri-arrow-right-line ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="ri-search-off-line display-1 text-muted"></i>
                            </div>
                            <h4 class="mb-3">
                                @if(app()->getLocale() == 'ar')
                                    لم يتم العثور على مشاريع
                                @else
                                    No projects found
                                @endif
                            </h4>
                            <p class="text-muted mb-4">
                                @if(app()->getLocale() == 'ar')
                                    لا توجد مشاريع مطابقة لمعايير البحث الخاصة بك
                                @else
                                    No projects match your search criteria
                                @endif
                            </p>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">
                                @if(app()->getLocale() == 'ar')
                                    عرض جميع المشاريع
                                @else
                                    View all projects
                                @endif
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="mt-5 pt-4">
                    <nav aria-label="Page navigation">
                        {{ $projects->links('vendor.pagination.custom') }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
/* Custom Animations */
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

@keyframes fadeUp {
    from { 
        opacity: 0;
        transform: translateY(20px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

.animate-slide-up {
    animation: slideUp 0.6s ease-out;
}

.animate-fade-up {
    animation: fadeUp 0.4s ease-out forwards;
    opacity: 0;
}

/* Card Hover Effects */
.project-card .card {
    transition: all 0.3s ease;
}

.project-card .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(15, 25, 54, 0.15) !important;
}

.project-card .card-img-top {
    transition: transform 0.5s ease;
}

.project-card .card:hover .card-img-top {
    transform: scale(1.05);
}

/* Tabs Styling */
.nav-pills .nav-link {
    padding: 12px 24px;
    border-radius: 12px;
    color: #6b7280;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    margin: 0 8px;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #0b4b8f, #0d6efd);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 15px rgba(11, 75, 143, 0.3);
}

.nav-pills .nav-link:hover:not(.active) {
    background: #f3f4f6;
    color: #374151;
}

/* Search Input Styling */
.compound-search-input {
    border-color: #e5e7eb !important;
}

.compound-search-input:focus {
    border-color: #0b4b8f !important;
    box-shadow: 0 0 0 3px rgba(11, 75, 143, 0.1) !important;
}

/* Suggestions Dropdown */
.compound-search-suggestions {
    background: white;
    border: 1px solid #e5e7eb;
    border-top: none;
}

.compound-search-suggestions .list-group-item {
    border: none;
    padding: 12px 16px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: background 0.2s ease;
}

.compound-search-suggestions .list-group-item:hover {
    background: #f9fafb;
}

/* Badge Styling */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Statistics Bar */
.statistics-bar {
    position: relative;
    z-index: 1;
    margin-top: -30px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

/* Custom Pagination */
.pagination {
    --bs-pagination-border-color: #e5e7eb;
    --bs-pagination-hover-border-color: #0b4b8f;
    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(11, 75, 143, 0.25);
    --bs-pagination-active-bg: #0b4b8f;
    --bs-pagination-active-border-color: #0b4b8f;
}

.page-link {
    border-radius: 8px;
    margin: 0 4px;
    padding: 8px 16px;
    font-weight: 500;
}

/* RTL Support */
[dir="rtl"] .ri-arrow-right-line::before {
    content: "\ea64";
}

[dir="rtl"] .ri-arrow-left-line::before {
    content: "\ea6e";
}

/* Responsive Design */
@media (max-width: 768px) {
    .compound-search-hero {
        padding-top: 80px !important;
        padding-bottom: 60px !important;
    }
    
    .nav-pills .nav-link {
        padding: 10px 16px;
        font-size: 0.875rem;
    }
    
    .statistics-bar {
        margin-top: -20px;
    }
    
    .project-card .card-body {
        padding: 20px !important;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .compound-search-box {
        background: rgba(30, 30, 46, 0.95) !important;
    }
    
    .project-card .card {
        background: #1e1e2e !important;
        color: #e2e8f0 !important;
    }
    
    .project-card .text-dark {
        color: #e2e8f0 !important;
    }
}

.pt-70,
.pb-70{
    padding-top: 70px;
    padding-bottom: 70px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search suggestions functionality
    const searchInputs = document.querySelectorAll('.compound-search-input');
    const suggestionContainers = document.querySelectorAll('.compound-search-suggestions');
    
    searchInputs.forEach((input, index) => {
        const container = suggestionContainers[index];
        
        input.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            if (query.length < 2) {
                container.style.display = 'none';
                return;
            }
            
            // Simulate AJAX call
            setTimeout(() => {
                const suggestions = [
                    { title: 'Palm Hills', type: 'compound', location: 'New Cairo' },
                    { title: 'Madinaty', type: 'compound', location: 'New Cairo' },
                    { title: 'El Rehab', type: 'compound', location: 'New Cairo' },
                    { title: 'Al Zahraa', type: 'property', location: 'North Coast' }
                ];
                
                const filtered = suggestions.filter(item => 
                    item.title.toLowerCase().includes(query.toLowerCase()) ||
                    item.location.toLowerCase().includes(query.toLowerCase())
                );
                
                if (filtered.length > 0) {
                    container.innerHTML = filtered.map(item => `
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${item.title}</strong>
                                    <div class="text-muted small">${item.location}</div>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary">${item.type}</span>
                            </div>
                        </a>
                    `).join('');
                    
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            }, 300);
        });
        
        input.addEventListener('blur', function() {
            setTimeout(() => {
                container.style.display = 'none';
            }, 200);
        });
    });
    
    // View mode toggle
    const gridViewBtn = document.getElementById('gridView');
    const listViewBtn = document.getElementById('listView');
    const projectWrapper = document.querySelector('.project-list-wrapper');
    
    gridViewBtn.addEventListener('change', function() {
        if (this.checked) {
            projectWrapper.classList.remove('row-cols-1');
            projectWrapper.classList.add('row-cols-1', 'row-cols-md-2', 'row-cols-lg-3');
        }
    });
    
    listViewBtn.addEventListener('change', function() {
        if (this.checked) {
            projectWrapper.classList.remove('row-cols-1', 'row-cols-md-2', 'row-cols-lg-3');
            projectWrapper.classList.add('row-cols-1');
            
            // Convert cards to list view
            document.querySelectorAll('.project-card').forEach(card => {
                card.classList.add('col-12');
                card.querySelector('.card').classList.add('flex-row');
                card.querySelector('.card').style.height = '200px';
                card.querySelector('.card-img-top').style.width = '300px';
                card.querySelector('.card-img-top').style.height = '100%';
            });
        }
    });
    
    // Reset to grid view on window resize
    window.addEventListener('resize', function() {
        if (gridViewBtn.checked) {
            document.querySelectorAll('.project-card').forEach(card => {
                card.querySelector('.card').classList.remove('flex-row');
                card.querySelector('.card').style.height = 'auto';
                card.querySelector('.card-img-top').style.width = '100%';
                card.querySelector('.card-img-top').style.height = '240px';
            });
        }
    });
});
</script>
@endpush
