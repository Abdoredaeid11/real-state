<!DOCTYPE html>
@php
    $settings = \App\Models\SiteSetting::first();
@endphp
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

   <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/scrollCue.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

        <title>{{ $settings && $settings->site_name ? $settings->site_name : 'AqarX' }}</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
        
        <style>
        
            .page-banner-area  {
                background-color: #0000009e;
                padding-top: 150px;
                padding-bottom: 150px;
                background-image: url(https://images.pexels.com/photos/1642125/pexels-photo-1642125.jpeg?_gl=1*tb2rey*_ga*MTkwNDE5Nzg4OC4xNzY3NjIyMzM5*_ga_8JE65Q40S6*czE3NjgyMTE5MDQkbzQkZzEkdDE3NjgyMTE5MjEkajQzJGwwJGgw);
                background-position: center center;
                background-blend-mode: overlay;
            }
            .page-banner-content h2,
            .page-banner-content ul li,
            .page-banner-content ul li a{
                color: #fff !important
            }
            .properties-item .properties-content .bottom .user img {
                max-width: 40px !important;
            }
            
            @media only screen and (max-width: 992px) {
                .top-header-area {
                    display: none;
                }
            }
        </style>
    </head>

    <body>

        <!-- Start Preloader Area -->
        <div class="preloader-area text-center position-fixed top-0 bottom-0 start-0 end-0" id="preloader">
            <div class="loader position-absolute start-0 end-0">
                <img src="{{ asset('assets/images/logo-original.png') }}" alt="favicon">
                <div class="waviy position-relative">
                    <span class="d-inline-block text-dark">A</span>
                    <span class="d-inline-block text-dark">Q</span>
                    <span class="d-inline-block text-dark">A</span>
                    <span class="d-inline-block text-dark">R</span>
                    <span class="d-inline-block text-dark">-</span>
                    <span class="d-inline-block text-dark">X</span>
                </div>
            </div>
        </div>
        <!-- End Preloader Area -->

        <!-- Start Top Header Area -->
        <div class="top-header-area">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <ul class="top-header-info-with-social">
                            <li>
                                <div class="social">
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                    <a href="https://twitter.com/" target="_blank">
                                        <i class="ri-twitter-x-line"></i>
                                    </a>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <i class="ri-instagram-fill"></i>
                                    </a>
                                    <a href="https://bd.linkedin.com/" target="_blank">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                    <a href="https://www.youtube.com/" target="_blank">
                                        <i class="ri-youtube-line"></i>
                                    </a>
                                    <a href="https://www.pinterest.com/" target="_blank">
                                        <i class="ri-pinterest-line"></i>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="mail-info">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:support@demo.com">{{ $settings->email }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-5 text-end">
                        <div class="top-header-call-info">
                            <i class="ri-phone-line"></i>
                            <a href="tel:201068710594">+(2) {{ $settings->phone }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Header Area -->
