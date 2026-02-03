@extends('layouts.master')
@section('content')
        
        <!-- Start Page Banner Area -->
        <div class="page-banner-area">
            <div class="container">
                <div class="page-banner-content">
                    <h2>Login / Register</h2>
                    <ul class="list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Account</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Page Banner Area -->
        
        
        <!-- Start Profile Authentication Area -->
        <div class="profile-authentication-area ptb-120">
            <div class="container">
                <div class="profile-authentication-inner">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="profile-authentication-box">
                                <div class="content">
                                    <h3>Sign In</h3>
                                </div>
                                @if ($errors->any() && old('form') === 'login')
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="authentication-form" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="form" value="login">
                                    <div class="google-btn">
                                        <button type="submit"><img src="assets/images/google.svg" alt="google">Sign in with Google</button>
                                    </div>
                                    <div class="or">
                                        <span>OR</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}" required>
                                        <div class="icon">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                        @if (old('form') === 'login')
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <select name="role" class="form-control">
                                            <option value="user" {{ old('role') === 'broker' ? '' : 'selected' }}>User</option>
                                            <option value="broker" {{ old('role') === 'broker' ? 'selected' : '' }}>Broker</option>
                                        </select>
                                        <div class="icon">
                                            <i class="ri-user-settings-line"></i>
                                        </div>
                                        @if (old('form') === 'login')
                                            @error('role')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Your Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Your password" required>
                                        <div class="icon">
                                            <i class="ri-lock-line"></i>
                                        </div>
                                        @if (old('form') === 'login')
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-bottom d-flex justify-content-between">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                            <label class="form-check-label" for="remember-me">
                                                Remember me
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="forgot-password">
                                            Forgot your password?
                                        </a>
                                    </div>
                                    <button type="submit" class="default-btn">Sign In</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="profile-authentication-box with-gap">
                                <div class="content">
                                    <h3>Create Your Account</h3>
                                    <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                                </div>
                                @if ($errors->any() && old('form') === 'register')
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="authentication-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="form" value="register">
                                    <div class="google-btn">
                                        <button type="submit"><img src="assets/images/google.svg" alt="google">Sign in with Google</button>
                                    </div>
                                    <div class="or">
                                        <span>OR</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ old('name') }}" required>
                                        <div class="icon">
                                            <i class="ri-user-3-line"></i>
                                        </div>
                                        @if (old('form') === 'register')
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}" required>
                                        <div class="icon">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                        @if (old('form') === 'register')
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <select id="register-role" name="role" class="form-control">
                                            <option value="user" {{ old('role') === 'broker' ? '' : 'selected' }}>User</option>
                                            <option value="broker" {{ old('role') === 'broker' ? 'selected' : '' }}>Broker</option>
                                        </select>
                                        <div class="icon">
                                            <i class="ri-user-settings-line"></i>
                                        </div>
                                        @if (old('form') === 'register')
                                            @error('role')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div id="register-broker-kyc" style="{{ old('role') === 'broker' ? '' : 'display:none' }}">
                                        <div class="form-group">
                                            <label>ID Image</label>
                                            <input type="file" id="register-id-image" name="id_image" class="form-control" accept="image/*">
                                            @if (old('form') === 'register')
                                                @error('id_image')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Selfie with ID</label>
                                            <input type="file" id="register-selfie-image" name="selfie_image" class="form-control" accept="image/*">
                                            @if (old('form') === 'register')
                                                @error('selfie_image')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Your password" required>
                                        <div class="icon">
                                            <i class="ri-lock-line"></i>
                                        </div>
                                        @if (old('form') === 'register')
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                                        <div class="icon">
                                            <i class="ri-lock-line"></i>
                                        </div>
                                        @if (old('form') === 'register')
                                            @error('password_confirmation')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="form-bottom">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkbox1">
                                            <label class="form-check-label" for="checkbox1">
                                                I accept the <a href="terms-conditions.html">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="default-btn">Sign Up</button>
                                </form>
                                <script>
                                    const regRole = document.getElementById('register-role');
                                    const regKyc = document.getElementById('register-broker-kyc');
                                    const regId = document.getElementById('register-id-image');
                                    const regSelfie = document.getElementById('register-selfie-image');
                                    function toggleRegKyc(){
                                        if(regRole.value === 'broker'){
                                            regKyc.style.display = '';
                                            if(regId) regId.required = true;
                                            if(regSelfie) regSelfie.required = true;
                                        }else{
                                            regKyc.style.display = 'none';
                                            if(regId) regId.required = false;
                                            if(regSelfie) regSelfie.required = false;
                                        }
                                    }
                                    regRole.addEventListener('change', toggleRegKyc);
                                    toggleRegKyc();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Profile Authentication Area -->

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
