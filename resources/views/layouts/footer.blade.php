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
                                    <h3>Company</h3>
                                    <ul class="custom-links">
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="contact-us.html">Contact Us</a></li>
                                        <li><a href="customers-review.html">Our Reviews</a></li>
                                        <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget ps-3">
                                    <h3>Resources</h3>
                                    <ul class="custom-links">
                                        <li><a href="property-grid.html">Apartments</a></li>
                                        <li><a href="property-grid.html">Villa</a></li>
                                        <li><a href="property-grid.html">Sell or Buy</a></li>
                                        <li><a href="property-grid.html">New Apartment</a></li>
                                        <li><a href="agents.html">Our Agents</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget ps-3">
                                    <h3>Quick Links</h3>
                                    <ul class="custom-links">
                                        <li><a href="pricing.html">Pricing</a></li>
                                        <li><a href="what-we-do.html">What We Do</a></li>
                                        <li><a href="customers-review.html">Testimonial</a></li>
                                        <li><a href="blog-grid.html">Blog</a></li>
                                        <li><a href="neighborhood.html">Neighborhood</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="single-footer-widget">
                                    <h3>Contact Info</h3>
                                    <ul class="info-list">
                                        @if($settings && $settings->address)
                                        <li>
                                            <span>Address:</span>
                                            {{ $settings->address }}
                                        </li>
                                        @endif
                                        @if($settings && $settings->email)
                                        <li>
                                            <span>Email:</span>
                                            <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                        </li>
                                        @endif
                                        @if($settings && $settings->phone)
                                        <li>
                                            <span>Phone:</span>
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
                        Copyright <span>{{ $settings && $settings->site_name ? $settings->site_name : 'Andora' }}</span> All Rights Reserved by <a href="https://envytheme.com/" target="_blank">EnvyTheme</a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->

        <!-- Back to Top -->
        <button type="button" id="back-to-top" class="position-fixed text-center border-0 p-0">
            <i class="ri-arrow-up-s-line"></i>
        </button>
        <!-- End Back to Top -->

        <!-- Start Lines -->
        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <!-- End Lines -->

        <!-- Link of JS Files -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollCue.min.js') }}"></script>
<script src="{{ asset('assets/js/fslightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/simpleParallax.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

    </body>
</html>
