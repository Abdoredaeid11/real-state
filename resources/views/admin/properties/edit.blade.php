@extends('admin.layout.master')
@section('content')
    <h4>{{ __('admin.general.edit') }} {{ __('admin.general.properties') }}</h4>
    <form action="{{ route('admin.properties.update', ['locale' => app()->getLocale(), 'id' => $property->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title') }}</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.title_ar') }}</label>
                <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $property->title_ar) }}">
            </div>
        </div>

        {{-- Description --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description') }}</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $property->description) }}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('admin.forms.description_ar') }}</label>
                <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar', $property->description_ar) }}</textarea>
            </div>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control"
                value="{{ old('price', $property->price) }}" required>
        </div>

        {{-- Type --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.type') }}</label>
            <select name="type" class="form-select" required>
                <option value="sale" {{ $property->type == 'sale' ? 'selected' : '' }}>Sale</option>
                <option value="rent" {{ $property->type == 'rent' ? 'selected' : '' }}>Rent</option>
                <option value="invest" {{ $property->type == 'invest' ? 'selected' : '' }}>Invest</option>

            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.status') }}</label>
            <select name="status" class="form-select" required>
                <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ $property->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="rented" {{ $property->status == 'rented' ? 'selected' : '' }}>Rented</option>
                <option value="off_market" {{ $property->status == 'off_market' ? 'selected' : '' }}>Off Market</option>
            </select>
        </div>

        {{-- Property Type --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.property_type') }}</label>
            <select name="property_type_id" class="form-select" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $property->property_type_id == $type->id ? 'selected' : '' }}>
                        {{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.category') }}</label>
            <select name="category_id" class="form-select">
                <option value="">{{ __('admin.forms.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $property->category_id == $category->id ? 'selected' : '' }}>
                        {{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- City --}}
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

        {{-- Address --}}
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

        {{-- Bedrooms --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bedrooms') }}</label>
            <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}">
        </div>

        {{-- Bathrooms --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.bathrooms') }}</label>
            <input type="number" name="bathrooms" class="form-control"
                value="{{ old('bathrooms', $property->bathrooms) }}">
        </div>

        {{-- Area --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.area') }}</label>
            <input type="number" name="area" class="form-control" value="{{ old('area', $property->area) }}">
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
            <label class="form-label d-flex justify-content-between">
                <span>{{ __('admin.forms.existing_images') }}</span>
                <small class="text-muted">{{ __('admin.forms.select_to_remove') }}</small>
            </label>
            @if($property->images->count())
                <div class="d-flex flex-wrap gap-3">
                    @foreach($property->images as $img)
                        <label class="text-center" style="width: 120px;">
                            <img src="{{ asset('storage/' . $img->image) }}" class="img-thumbnail mb-2" style="height: 90px; object-fit: cover;">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $img->id }}" id="removeImage{{ $img->id }}">
                                <label class="form-check-label small" for="removeImage{{ $img->id }}">Remove</label>
                            </div>
                        </label>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No images uploaded yet.</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Add New Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
            <small class="text-muted">JPG, PNG, WEBP up to 2MB each.</small>
        </div>

        {{-- Broker --}}
        <div class="mb-3">
            <label class="form-label">Broker</label>
            <select name="broker_id" class="form-select">
                  <option value="">no broker</option>
                @foreach ($brokers as $broker)
                    <option value="{{ $broker->id }}" {{ $property->broker_id == $broker->id ? 'selected' : '' }}>
                        {{ $broker->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Property</button>
        <a href="{{ route('admin.properties.index', app()->getLocale()) }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
