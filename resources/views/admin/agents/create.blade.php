@extends('admin.layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>{{ __('admin.general.create') }} {{ __('admin.general.agents') }}</h4>
        <a href="{{ route('admin.agents.index', app()->getLocale()) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> {{ __('admin.general.back') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.agents.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.forms.name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.general.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.general.phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('admin.general.status') }}</label>
                        <select name="status" class="form-select" required>
                            <option value="active" @selected(old('status')==='active')>Active</option>
                            <option value="inactive" @selected(old('status')==='inactive')>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">{{ __('admin.forms.image') }}</label>
                        <input type="file" name="profile_image" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <h6>Social Links</h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Twitter</label>
                        <input type="url" name="twitter" class="form-control" value="{{ old('twitter') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram" class="form-control" value="{{ old('instagram') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="youtube" class="form-control" value="{{ old('youtube') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
            </form>
        </div>
    </div>
@endsection

