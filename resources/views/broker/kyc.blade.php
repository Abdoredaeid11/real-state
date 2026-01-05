@extends('layouts.master')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Broker KYC</h2>
                <ul class="list">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li>KYC</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="profile-authentication-area ptb-120">
        <div class="container">
            <div class="profile-authentication-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="profile-authentication-box">
                            <div class="content">
                                <h3>Complete Your Verification</h3>
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(isset($verification))
                                    <div class="alert alert-info">
                                        Status: {{ ucfirst($verification->status) }}
                                        @if($verification->status === 'rejected' && $verification->rejection_reason)
                                            <br>Reason: {{ $verification->rejection_reason }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <form class="authentication-form" action="{{ route('broker.kyc.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>ID Image</label>
                                    <input type="file" name="id_image" class="form-control" required>
                                    @error('id_image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Selfie with ID</label>
                                    <input type="file" name="selfie_image" class="form-control" required>
                                    @error('selfie_image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="default-btn">Submit Verification</button>
                            </form>
                            <p class="mt-3">بعد الإرسال، سيتم مراجعة الطلب. الرجاء انتظار الموافقة.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
