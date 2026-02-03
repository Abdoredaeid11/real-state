  <!-- Start Footer Area -->
  @php
      $settings = \App\Models\SiteSetting::first();
  @endphp
        <footer class="footer-area pt-120">
            <div class="container">
                <div class="row justify-content-center" data-cues="slideInUp">
                    <div class="col-xl-3 col-md-12">
                        <div class="single-footer-widget pe-3">
                            <div class="widget-logo">
                                <a href="{{ route('home.index') }}">
                                    <img src="{{ $settings && $settings->logo ? asset($settings->logo) : asset('assets/images/logo2.png') }}" alt="logo2">
                                </a>
                            </div>
                            <p>{{ $settings && $settings->site_description ? $settings->site_description : 'Lorem ipsum dolor sit amet, elit dollar consectetur adipiscing elit. Diam lectus purus ultricies neque.' }}</p>
                            <div class="widget-social">
                                @if($settings && $settings->facebook)
                                <a href="{{ $settings->facebook }}" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                @endif
                                @if($settings && $settings->twitter)
                                <a href="{{ $settings->twitter }}" target="_blank">
                                    <i class="ri-twitter-x-line"></i>
                                </a>
                                @endif
                                @if($settings && $settings->instagram)
                                <a href="{{ $settings->instagram }}" target="_blank">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                                @endif
                                @if($settings && $settings->linkedin)
                                <a href="{{ $settings->linkedin }}" target="_blank">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                                @endif
                                <a href="https://www.youtube.com/" target="_blank">
                                    <i class="ri-youtube-line"></i>
                                </a>
                                <a href="https://www.pinterest.com/" target="_blank">
                                    <i class="ri-pinterest-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-12">
                        <div class="row justify-content-center" data-cues="slideInUp">
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget ps-3">
                                    <h3>{{ __('website.footer.company') }}</h3>
                                    <ul class="custom-links">
                                        <li><a href="#">{{ __('website.footer.about_us') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.contact_us') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.our_reviews') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.terms') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.privacy') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget ps-3">
                                    <h3>{{ __('website.footer.resources') }}</h3>
                                    <ul class="custom-links">
                                        <li><a href="#">{{ __('website.footer.apartments') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.villa') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.sell_or_buy') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.new_apartment') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.our_agents') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget ps-3">
                                    <h3>{{ __('website.footer.quick_links') }}</h3>
                                    <ul class="custom-links">
                                        <li><a href="#">{{ __('website.footer.pricing') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.what_we_do') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.testimonial') }}</a></li>
                                        <li><a href="#">{{ __('website.footer.blog') }}</a></li>
                                        <li><a href="#l">{{ __('website.footer.neighborhood') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget">
                                    <h3>{{ __('website.footer.contact_info') }}</h3>
                                    <ul class="info-list">
                                        @if($settings && $settings->address)
                                        <li>
                                            <span>{{ __('website.footer.address') }}</span>
                                            {{ $settings->address }}
                                        </li>
                                        @endif
                                        @if($settings && $settings->email)
                                        <li>
                                            <span>{{ __('website.footer.email') }}</span>
                                            <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                        </li>
                                        @endif
                                        @if($settings && $settings->phone)
                                        <li>
                                            <span>{{ __('website.footer.phone') }}</span>
                                            <a href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <p>
                        Copyright <span>{{ $settings && $settings->site_name ? $settings->site_name : 'AqarX' }}</span> {{ __('website.footer.copyright_prefix') }} <a href="https://vadecom.net/" target="_blank">Vadecom</a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->

        <!-- Back to Top -->
        <button type="button" id="back-to-top" class="position-fixed text-center border-0 p-0" style="display: none;">
            <i class="ri-arrow-up-s-line"></i>
        </button>
        <!-- End Back to Top -->


        <!-- Link of JS Files -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollCue.min.js') }}"></script>
<script src="{{ asset('assets/js/fslightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/simpleParallax.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('scripts')

    </body>
</html>
