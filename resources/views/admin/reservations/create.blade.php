@extends('admin.layout.master')

@section('content')
    <h4>{{ __('admin.general.create_reservation') }}</h4>

    <form action="{{ route('admin.reservations.store', app()->getLocale()) }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.general.customer_name') }}</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">{{ __('admin.general.phone') }}</label>
            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">{{ __('admin.general.email') }}</label>
            <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">{{ __('admin.general.properties') }}</label>
            <select name="property_id" class="form-select">
                <option value="">{{ __('admin.general.unassigned') }}</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" @selected(old('property_id')==$property->id)>{{ app()->getLocale() == 'ar' ? $property->title_ar ?? $property->title : $property->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('admin.filters.broker') }}</label>
            <select name="broker_id" class="form-select">
                <option value="">{{ __('admin.general.unassigned') }}</option>
                @foreach($brokers as $broker)
                    <option value="{{ $broker->id }}" @selected(old('broker_id')==$broker->id)>{{ app()->getLocale() == 'ar' ? $broker->name_ar ?? $broker->name : $broker->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">{{ __('admin.general.check_in') }}</label>
            <input type="date" name="check_in" value="{{ old('check_in') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">{{ __('admin.general.check_out') }}</label>
            <input type="date" name="check_out" value="{{ old('check_out') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">{{ __('admin.general.status') }}</label>
            <select name="status" class="form-select">
                @foreach(['pending','contacted','confirmed','cancelled'] as $status)
                    <option value="{{ $status }}" @selected(old('status','pending')==$status)>{{ __('admin.reservation_statuses.' . $status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">{{ __('admin.general.expected_value') }}</label>
            <input type="number" step="0.01" name="expected_value" value="{{ old('expected_value',0) }}" class="form-control">
        </div>
        <div class="col-6">
            <label class="form-label">{{ __('admin.forms.notes') }}</label>
            <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
        </div>
        <div class="col-6">
            <label class="form-label">{{ __('admin.forms.notes_ar') }}</label>
            <textarea name="notes_ar" rows="3" class="form-control" dir="rtl">{{ old('notes_ar') }}</textarea>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ __('admin.general.save_reservation') }}</button>
            <a href="{{ route('admin.reservations.index', app()->getLocale()) }}" class="btn btn-secondary">{{ __('admin.general.cancel') }}</a>
        </div>
    </form>
@endsection


