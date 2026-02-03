@extends('broker.layout.master')
@section('content')
    <h4>{{ __('admin.general.edit') }} {{ __('admin.general.properties') }}</h4>

    <form action="{{ route('broker.properties.update', ['locale' => app()->getLocale(), 'id' => $property->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title') }}</label>
                <input type="text" name="title" class="form-control" placeholder="{{ __('admin.forms.enter_title') }}" value="{{ old('title', $property->title) }}" required>   
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title_ar') }}</label>
                <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $property->title_ar) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description') }}</label>
                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $property->description) }}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                <textarea name="description_ar" class="form-control" rows="3" placeholder="{{ __('admin.forms.enter_description_ar') }}">{{ old('description_ar', $property->description_ar) }}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $property->price) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.type') }}</label>
                <select name="type" class="form-select" required>
                    <option value="sale" {{ old('type', $property->type) === 'sale' ? 'selected' : '' }}>Sale</option>
                    <option value="rent" {{ old('type', $property->type) === 'rent' ? 'selected' : '' }}>Rent</option>
                    <option value="invest" {{ old('type', $property->type) === 'invest' ? 'selected' : '' }}>Invest</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.property_type') }}</label>
                <select name="property_type_id" class="form-select" required>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('property_type_id', $property->property_type_id) == $type->id ? 'selected' : '' }}>
                            {{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city') }}</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $property->city) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.city_ar') }}</label>
                <input type="text" name="city_ar" class="form-control" value="{{ old('city_ar', $property->city_ar) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.address') }}</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $property->address) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.address_ar') }}</label>
                <input type="text" name="address_ar" class="form-control" value="{{ old('address_ar', $property->address_ar) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.latitude') }}</label>
                <input type="number" step="0.0000001" name="latitude" class="form-control" value="{{ old('latitude', $property->latitude) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.longitude') }}</label>
                <input type="number" step="0.0000001" name="longitude" class="form-control" value="{{ old('longitude', $property->longitude) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.map_url') }}</label>
                <input type="url" name="map_url" class="form-control" value="{{ old('map_url', $property->map_url) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.category') }}</label>
            <select name="category_id" class="form-select">
                <option value="">{{ __('admin.forms.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                        {{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.features') }}</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($features as $feature)
                    @php $label = app()->getLocale() === 'ar' ? ($feature->name_ar ?? $feature->name_en) : $feature->name_en; @endphp
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="feature_ids[]"
                            value="{{ $feature->id }}"
                            id="feature{{ $feature->id }}"
                            @checked(in_array($feature->id, old('feature_ids', $property->features->pluck('id')->all())))
                        >
                        <label class="form-check-label" for="feature{{ $feature->id }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.bedrooms') }}</label>
                <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.bathrooms') }}</label>
                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">{{ __('admin.forms.area') }}</label>
                <input type="number" name="area" class="form-control" value="{{ old('area', $property->area) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.image') }} (Floor Plan)</label>
            <input type="file" name="floor_plan" class="form-control">
            @if($property->floor_plan)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $property->floor_plan) }}" alt="Floor Plan" style="max-height:120px; border-radius:6px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.existing_images') }}</label>
            @if($property->images->count())
                <div class="d-flex flex-wrap gap-3">
                    @foreach($property->images as $img)
                        <div style="width: 120px;" class="text-center">
                            <img src="{{ asset('storage/' . $img->image) }}" class="img-thumbnail mb-2" style="height: 90px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No images uploaded yet.</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Add New Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('admin.general.update') }}
        </button>
        <a href="{{ route('broker.properties.index', app()->getLocale()) }}" class="btn btn-secondary">
            {{ __('admin.general.cancel') }}
        </a>
    </form>
@endsection
