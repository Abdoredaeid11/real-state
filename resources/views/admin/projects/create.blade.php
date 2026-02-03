@extends('admin.layout.master')
@section('content')
    <h4>{{ __('admin.general.create') }} {{ __('admin.general.projects') }}</h4>

    <form action="{{ route('admin.projects.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.general.name') }} (EN)</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
                <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.general.status') }}</label>
                <select name="status" class="form-select" required>
                    <option value="active" @selected(old('status')==='active')>Active</option>
                    <option value="inactive" @selected(old('status')==='inactive')>Inactive</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select" required>
                    <option value="compound" @selected(old('type')==='compound')>Compound</option>
                    <option value="property" @selected(old('type')==='property')>Property</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Developer</label>
                <input type="text" name="developer" class="form-control" value="{{ old('developer') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.location') }}</label>
                <input type="text" name="location_text" class="form-control" value="{{ old('location_text') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city') }}</label>
                <input type="text" name="city" class="form-control" value="{{ old('city') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city_ar') }}</label>
                <input type="text" name="city_ar" class="form-control" value="{{ old('city_ar') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Starting Price</label>
                <input type="number" step="0.01" name="starting_price" class="form-control"
                       value="{{ old('starting_price') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Currency</label>
                <input type="text" name="price_currency" class="form-control" value="{{ old('price_currency', 'EGP') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Installments up to</label>
                <input type="text" name="installments_up_to" class="form-control"
                       value="{{ old('installments_up_to') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Min Bedrooms</label>
                <input type="number" name="min_bedrooms" class="form-control" value="{{ old('min_bedrooms') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Max Bedrooms</label>
                <input type="number" name="max_bedrooms" class="form-control" value="{{ old('max_bedrooms') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Delivery Year</label>
                <input type="number" name="delivery_year" class="form-control" value="{{ old('delivery_year') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description') }} (EN)</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar') }}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Main Image</label>
            <input type="file" name="main_image_file" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.images') }}</label>
            <input type="file" name="gallery_images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
        <a href="{{ route('admin.projects.index', app()->getLocale()) }}" class="btn btn-secondary">
            {{ __('admin.general.cancel') }}
        </a>
    </form>
@endsection

