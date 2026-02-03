@extends('admin.layout.master')
@section('content')
    @php $locale = app()->getLocale(); @endphp
    <h4 class="mb-3">{{ __('admin.general.edit') }} {{ __('admin.general.features') ?? 'Feature' }}</h4>
    <form action="{{ route('admin.features.update', ['locale' => $locale, 'id' => $feature->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.enter_name') }} (EN)</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $feature->name_en) }}" required>
            @error('name_en')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $feature->name_ar) }}" required>
            @error('name_ar')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
        <a href="{{ route('admin.features.index', $locale) }}" class="btn btn-secondary">{{ __('admin.general.cancel') }}</a>
    </form>
@endsection

