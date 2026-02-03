@extends('layouts.master')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Add Property</h2>
                <ul class="list">
                    <li>
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li>Add Property</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="properties-area ptb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="properties-grid-box">
                        <h3 class="mb-4">Submit Your Property</h3>

                        <form action="{{ route('user.properties.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{ old('title') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                           value="{{ old('price') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Select type</option>
                                        <option value="sale" @selected(old('type')==='sale')>For Sale</option>
                                        <option value="rent" @selected(old('type')==='rent')>For Rent</option>
                                        <option value="invest" @selected(old('type')==='invest')>Invest</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Property Type</label>
                                    <select name="property_type_id" class="form-select" required>
                                        <option value="">Select type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" @selected(old('property_type_id')==$type->id)>
                                                {{ app()->getLocale() == 'ar' ? ($type->name_ar ?? $type->name) : $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                                            {{ app()->getLocale() == 'ar' ? ($category->name_ar ?? $category->name) : $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control"
                                           value="{{ old('city') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control"
                                           value="{{ old('address') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Bedrooms</label>
                                    <input type="number" name="bedrooms" class="form-control"
                                           value="{{ old('bedrooms') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Bathrooms</label>
                                    <input type="number" name="bathrooms" class="form-control"
                                           value="{{ old('bathrooms') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Area (m²)</label>
                                    <input type="number" name="area" class="form-control"
                                           value="{{ old('area') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Floor Plan</label>
                                <input type="file" name="floor_plan" class="form-control">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Property Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>

                            <button type="submit" class="default-btn">
                                Submit Property
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

