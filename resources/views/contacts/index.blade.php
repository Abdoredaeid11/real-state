@extends('layouts.master')
@section('content')
@php
    $settings = \App\Models\SiteSetting::first();
@endphp
        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
            <div class="container">
                <div class="page-banner-content">
                    <h2>{{ __('website.contact.title') }}</h2>
                    <ul class="list">
                        <li>
                            <a href="{{ route('home.index') }}">{{ __('website.contact.breadcrumb_home') }}</a>
                        </li>
                        <li>{{ __('website.contact.breadcrumb_current') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner Area -->

        <!-- Start Contact Area -->
        <div class="contact-area ptb-120">
            <div class="container">
                <div class="row justify-content-center" data-cues="slideInUp">
                    <div class="col-lg-4 col-md-5">
                        <div class="contact-info-box">
                            <div class="box">
                                <div class="icon">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div class="info">
                                    <h4>{{ __('website.contact.location_title') }}</h4>
                                    <span>45/15 New alsala Avenew Booston town, Austria</span>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div class="info">
                                    <h4>{{ __('website.contact.phone_title') }}</h4>
                                    <span>
                                        <a href="tel:00201068710594">+(002) {{ $settings->phone }}</a>
                                    </span>
                                    <span>
                                        <a href="tel:00201068710588">+(002) 0106-8710-588</a>
                                    </span>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon">
                                    <i class="ri-mail-send-line"></i>
                                </div>
                                <div class="info">
                                    <h4>{{ __('website.contact.email_title') }}</h4>
                                    <span>
                                        <a href="mailto:supportinfo@andora.com">{{ $settings->email }}</a>
                                    </span>
                                    <span>
                                        <a href="mailto:contact@info.com">contact@info.com</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="contact-wrap-form">
                            <h3>{{ __('website.contact.form_title') }}</h3>
                            <form method="POST" action="{{ route('contact.send') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('website.contact.name_label') }}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ __('website.contact.name_placeholder') }}">
                                    <div class="icon">
                                        <i class="ri-user-3-line"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('website.contact.email_label') }}</label>
                                    <input type="email" class="form-control" name="email" placeholder="{{ __('website.contact.email_placeholder') }}">
                                    <div class="icon">
                                        <i class="ri-mail-line"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('website.contact.phone_label') }}</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="{{ __('website.contact.phone_placeholder') }}">
                                    <div class="icon">
                                        <i class="ri-phone-line"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('website.contact.subject_label') }}</label>
                                    <input type="text" class="form-control" name="subject" placeholder="{{ __('website.contact.subject_placeholder') }}">
                                    <div class="icon">
                                        <i class="ri-file-line"></i>
                                    </div>
                                </div>
                                <div class="form-group extra-top">
                                    <label>{{ __('website.contact.message_label') }}</label>
                                    <textarea class="form-control" name="message" placeholder="{{ __('website.contact.message_placeholder') }}"></textarea>
                                    <div class="icon">
                                        <i class="ri-message-2-line"></i>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" class="default-btn">{{ __('website.contact.send_button') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Area -->

        <!-- Start Map -->
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2751228.88121311!2d10.706860407488707!3d47.66991201325446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d079b259d2a7f%3A0x1012d47bdde4c1af!2sAustria!5e0!3m2!1sen!2sbd!4v1703576701537!5m2!1sen!2sbd"></iframe>
        </div>
        <!-- End Map -->

@endsection
