@extends('broker.layout.master')
@section('content')
    <h4>{{ __('admin.general.create') }} {{ __('admin.general.properties') }}</h4>

    <form action="{{ route('broker.properties.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title') }}</label>
                <input type="text" name="title" class="form-control" placeholder="{{ __('admin.forms.enter_title') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title_ar') }}</label>
                <input type="text" name="title_ar" class="form-control" placeholder="{{ __('admin.forms.enter_title') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description') }}</label>
                <textarea name="description" class="form-control" rows="3" placeholder="{{ __('admin.forms.enter_description') }}" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                <textarea name="description_ar" class="form-control" rows="3" placeholder="{{ __('admin.forms.enter_description') }}"></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" placeholder="{{ __('admin.forms.enter_price') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.type') }}</label>
            <select name="type" class="form-select" required>
                <option value="sale">Sale</option>
                <option value="rent">Rent</option>
                <option value="invest">Invest</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.property_type') }}</label>
            <select name="property_type_id" class="form-select" required>
                <option value="" disabled selected>{{ __('admin.forms.select_type') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.category') }}</label>
            <select name="category_id" class="form-select">
                <option value="" selected>{{ __('admin.forms.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}</option>
                @endforeach
            </select>
        </div>

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

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bedrooms') }}</label>
            <input type="number" name="bedrooms" class="form-control" placeholder="{{ __('admin.forms.enter_bedrooms') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bathrooms') }}</label>
            <input type="number" name="bathrooms" class="form-control" placeholder="{{ __('admin.forms.enter_bathrooms') }}">
        </div>

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

        <button type="submit" class="btn btn-primary">
            {{ __('admin.general.create') }}
        </button>
        <a href="{{ route('broker.properties.index', app()->getLocale()) }}" class="btn btn-secondary">
            {{ __('admin.general.cancel') }}
        </a>
    </form>
@endsection
