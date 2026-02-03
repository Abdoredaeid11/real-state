@extends('admin.layout.master')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>{{ __('admin.general.create') }} {{ __('admin.general.property_types') }}</h4>
        <a href="{{ route('admin.property-types.index', app()->getLocale()) }}" class="btn btn-secondary">{{ __('admin.general.back_to_list') }}</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.property-types.store', app()->getLocale()) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">{{ __('admin.forms.name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="{{ __('admin.forms.enter_name') }}" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
                    <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                        placeholder="{{ __('admin.forms.enter_name') }}" value="{{ old('name_ar') }}">
                    @error('name_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
