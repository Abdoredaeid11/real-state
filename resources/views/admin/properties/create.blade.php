@extends('admin.layout.master')
@section('content')
    <h4>{{ __('admin.general.create') }} {{ __('admin.general.properties') }}</h4>

    <form action="{{ route('admin.properties.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data" >
        @csrf

        {{-- Title --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title') }}</label>
                <input type="text" name="title" class="form-control" placeholder="{{ __('admin.forms.enter_title') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title_ar') }}</label>
                <input type="text" name="title_ar" class="form-control" placeholder="{{ __('admin.forms.enter_title') }}" >
            </div>
        </div>

        {{-- Description --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description') }}</label>
                <textarea name="description" class="form-control" rows="3" placeholder="{{ __('admin.forms.enter_description') }}"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                <textarea name="description_ar" class="form-control" rows="3" placeholder="{{ __('admin.forms.enter_description') }}"></textarea>
            </div>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" placeholder="{{ __('admin.forms.enter_price') }}"
                required>
        </div>

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.type') }}</label>
            <select name="type" class="form-select" required>
                <option value="sale">Sale</option>
                <option value="rent">Rent</option>
                <option value="invest">Invest</option>

            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.status') }}</label>
            <select name="status" class="form-select" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
                <option value="rented">Rented</option>
                <option value="off_market">Off Market</option>
            </select>
        </div>

        {{-- Property Type --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.property_type') }}</label>
            <select name="property_type_id" class="form-select" required>
                <option value="" disabled selected>{{ __('admin.forms.select_type') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.category') }}</label>
            <select name="category_id" class="form-select">
                <option value="" selected>{{ __('admin.forms.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Features --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.features') }}</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($features as $feature)
                    @php $label = app()->getLocale() === 'ar' ? ($feature->name_ar ?? $feature->name_en) : $feature->name_en; @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="feature_ids[]" value="{{ $feature->id }}" id="feature{{ $feature->id }}">
                        <label class="form-check-label" for="feature{{ $feature->id }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- City --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city') }}</label>
                <input type="text" name="city" class="form-control" placeholder="{{ __('admin.forms.enter_city') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city_ar') }}</label>
                <input type="text" name="city_ar" class="form-control" placeholder="{{ __('admin.forms.enter_city') }}">
            </div>
        </div>

        {{-- Address --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.address') }}</label>
                <input type="text" name="address" class="form-control" placeholder="{{ __('admin.forms.enter_address') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.address_ar') }}</label>
                <input type="text" name="address_ar" class="form-control" placeholder="{{ __('admin.forms.enter_address') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.latitude') }}</label>
                <input type="number" step="0.0000001" name="latitude" class="form-control" value="{{ old('latitude') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.longitude') }}</label>
                <input type="number" step="0.0000001" name="longitude" class="form-control" value="{{ old('longitude') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.map_url') }}</label>
                <input type="url" name="map_url" class="form-control" value="{{ old('map_url') }}">
            </div>
        </div>

        {{-- Bedrooms --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bedrooms') }}</label>
            <input type="number" name="bedrooms" class="form-control" placeholder="{{ __('admin.forms.enter_bedrooms') }}">
        </div>

        {{-- Bathrooms --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bathrooms') }}</label>
            <input type="number" name="bathrooms" class="form-control" placeholder="{{ __('admin.forms.enter_bathrooms') }}">
        </div>

        {{-- Area --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.area') }}</label>
            <input type="number" name="area" class="form-control" placeholder="{{ __('admin.forms.enter_area') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.image') }} (Floor Plan)</label>
            <input type="file" name="floor_plan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.images') }}</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        {{-- Broker --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.broker') }}</label>
            <select name="broker_id" class="form-select">
                <option value="" disabled selected>{{ __('admin.forms.select_broker') }}</option>
                @foreach ($brokers as $broker)
                    <option value="{{ $broker->id }}">{{ $broker->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Property</button>
    </form>
@endsection
