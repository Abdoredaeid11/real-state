@extends('admin.layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>{{ __('admin.general.create') }} {{ __('admin.general.category') }}</h4>
    <a href="{{ route('admin.categories.index', app()->getLocale()) }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i> {{ __('admin.general.back') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('admin.forms.name') }} (EN)</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('admin.forms.name') }} (AR)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">{{ __('admin.forms.image') }}</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('admin.general.save') }}</button>
        </form>
    </div>
</div>
@endsection
