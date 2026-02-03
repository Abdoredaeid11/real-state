@extends('layouts.master')
@section('content')
        
        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Blog Details</h2>
                    <ul class="list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Single Blog</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner Area -->
        
        <!-- Start Blog Details Area -->
        <div class="blog-details-area ptb-120">
            <div class="container">
                <div class="blog-details-desc" data-cues="slideInUp">
                    <div class="article-content">
                        <div class="image">
                            <img src="{{ isset($post) && $post->image ? asset('storage/' . $post->image) : asset('assets/images/blog-details/blog-details1.jpg') }}" alt="image">
                        </div>
                        <div class="content">
                            @if(isset($post->category))
                                <a href="#" class="tag-btn">{{ $post->category->name }}</a>
                            @endif
                            <ul class="meta">
                                <li>
                                    <div class="info">
                                        <img src="{{ isset($post->author) && $post->author->image ? asset('storage/' . $post->author->image) : asset('assets/images/user/user1.png') }}" alt="image">
                                        <span>By <a href="#">{{ $post->author?->name ?? 'Admin' }}</a></span>
                                    </div>
                                </li>
                                <li>
                                    <i class="ri-calendar-2-line"></i>
                                    {{ optional($post->published_at ?? $post->created_at)->format('F j, Y') }}
                                </li>
                                <li>
                                    <i class="ri-message-2-line"></i>
                                    {{ $post->comments_count ?? '0' }} Comments
                                </li>
                            </ul>
                            <h2>{{ $post->title ?? 'Blog Details' }}</h2>
                            <div class="post-body">
                                {!! $post->content ?? $post->body ?? '<p>No content available.</p>' !!}
                            </div>
                        </div>
                    </div>

                    @if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
                        <div class="article-block">
                            <div class="row justify-content-center">
                                @foreach($relatedPosts as $rp)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="block-image">
                                            <a href="{{ route('blog.show', $rp->slug ?? $rp->id) }}">
                                                <img src="{{ $rp->image ? asset('storage/' . $rp->image) : asset('assets/images/blog-details/blog-details2.jpg') }}" style="height: 200px" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="article-footer">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-7 col-md-7">
                                <ul class="tags">
                                    <li>
                                        <span>Tags:</span>
                                    </li>
                                    {{-- if tags relation exists, render them --}}
                                    @if(isset($post->tags))
                                        @foreach($post->tags as $tag)
                                            <li><a href="#">{{ $tag->name }}</a></li>
                                        @endforeach
                                    @else
                                        <li><a href="#">Real-Estate</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <ul class="social">
                                    <li>
                                        <span>Social Share:</span>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank"><i class="ri-facebook-fill"></i></a>
                                        <a href="https://twitter.com/" target="_blank"><i class="ri-twitter-fill"></i></a>
                                        <a href="https://www.instagram.com/" target="_blank"><i class="ri-instagram-line"></i></a>
                                        <a href="https://www.youtube.com/" target="_blank"><i class="ri-youtube-fill"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

             
                </div>
            </div>
        </div>
        <!-- End Blog Details Area -->
        
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