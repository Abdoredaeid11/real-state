@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>{{ __('admin.settings.site_settings') }}</h1>
    <form action="{{ route('admin.site-settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>{{ __('admin.settings.site_name') }}</label>
            <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.site_description') }}</label>
            <textarea name="site_description" class="form-control">{{ $settings->site_description }}</textarea>
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.logo') }}</label>
            <input type="text" name="logo" value="{{ $settings->logo }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.favicon') }}</label>
            <input type="text" name="favicon" value="{{ $settings->favicon }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.phone') }}</label>
            <input type="text" name="phone" value="{{ $settings->phone }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.email') }}</label>
            <input type="email" name="email" value="{{ $settings->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.address') }}</label>
            <textarea name="address" class="form-control">{{ $settings->address }}</textarea>
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.facebook') }}</label>
            <input type="url" name="facebook" value="{{ $settings->facebook }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.twitter') }}</label>
            <input type="url" name="twitter" value="{{ $settings->twitter }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.instagram') }}</label>
            <input type="url" name="instagram" value="{{ $settings->instagram }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.linkedin') }}</label>
            <input type="url" name="linkedin" value="{{ $settings->linkedin }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.about_us') }}</label>
            <textarea name="about_us" class="form-control">{{ $settings->about_us }}</textarea>
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.privacy_policy') }}</label>
            <textarea name="privacy_policy" class="form-control">{{ $settings->privacy_policy }}</textarea>
        </div>
        <div class="form-group">
            <label>{{ __('admin.settings.terms_conditions') }}</label>
            <textarea name="terms_conditions" class="form-control">{{ $settings->terms_conditions }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('admin.settings.save_settings') }}</button>
    </form>
</div>
@endsection
