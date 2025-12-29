@extends('admin.layout.master')

@section('content')
<div class="container mt-4">
    <h4>{{ __('admin.general.edit') }} {{ __('admin.general.property_types') }}</h4>
    <form action="{{ route('admin.property-types.update', ['locale' => app()->getLocale(), 'id' => $type->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.name') }}</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $type->name) }}" placeholder="{{ __('admin.forms.enter_name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control"
                   value="{{ old('name_ar', $type->name_ar) }}" placeholder="{{ __('admin.forms.enter_name') }}">
            @error('name_ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
        <a href="{{ route('admin.property-types.index', app()->getLocale()) }}" class="btn btn-secondary">{{ __('admin.general.cancel') }}</a>
    </form>
</div>
@endsection
