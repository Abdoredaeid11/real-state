@extends('layouts.master')
@section('content')
    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>{{ __('website.blog.title') }}</h2>
                <ul class="list">
                    <li>
                        <a href="{{ route('home.index') }}">{{ __('website.blog.breadcrumb_home') }}</a>
                    </li>
                    <li>{{ __('website.blog.breadcrumb_current') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Blog Area -->
    <div class="blog-area ptb-120">
        <div class="container">
            <div class="row justify-content-center" data-cues="slideInUp">
                @foreach ($blogs as $post)
                    <div class="col-xl-4 col-md-6">
                        <div class="blog-card">
                            <div class="blog-image">
                                <a href="blog-details.html">
                                    <img src="{{ isset($post) && $post->image ? asset('storage/' . $post->image) : asset('assets/images/blog-details/blog-details1.jpg') }}"
                                        alt="image" style="height: 215px ; width: 100%;">
                                </a>
                                <a href="blog-grid.html" class="tag-btn">{{ $post->title ?? 'Blog Details' }}</a>
                                <a href="author.html" class="author-btn">
                                    <img src="assets/images/user/user1.png" alt="image">
                                </a>
                            </div>
                            <div class="blog-content">
                                <ul class="meta">
                                    <li>
                                        <i class="ri-calendar-2-line"></i>
                                        {{ optional($post->published_at ?? $post->created_at)->format('F j, Y') }}
                                    </li>
                                    <li>
                                        <i class="ri-message-2-line"></i>
                                        {{ $post->comments_count ?? '0' }} {{ __('website.blog.comments') }}
                                    </li>
                                </ul>
                                <h3>
                                    <a href="{{ route('blog.show', $post->slug ?? $post->id) }}">{{ Str::limit(strip_tags($post->content ?? $post->body), 60) }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach


                @if ($blogs->hasPages())
                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            <div class="nav-links">

                                {{-- Previous --}}
                                @if ($posts->onFirstPage())
                                    <span class="prev page-numbers disabled">
                                        <i class="ri-arrow-left-s-line"></i>
                                    </span>
                                @else
                                    <a href="{{ $posts->previousPageUrl() }}" class="prev page-numbers">
                                        <i class="ri-arrow-left-s-line"></i>
                                    </a>
                                @endif

                                {{-- Pages --}}
                                @foreach ($posts->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $posts->currentPage())
                                        <span class="page-numbers current">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Next --}}
                                @if ($posts->hasMorePages())
                                    <a href="{{ $posts->nextPageUrl() }}" class="next page-numbers">
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                @else
                                    <span class="next page-numbers disabled">
                                        <i class="ri-arrow-right-s-line"></i>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- End Blog Area -->

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
    <!-- End Subscribe Area -->
@endsection
