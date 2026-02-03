@extends('admin.layout.master')

@section('content')
    <h4>{{ __('admin.general.create_payment') }}</h4>

    <form action="{{ route('admin.payments.store', app()->getLocale()) }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.general.reservation') }}</label>
            <select name="reservation_id" class="form-select">
                <option value="">{{ __('admin.general.unlinked') }}</option>
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}" @selected(old('reservation_id')==$reservation->id)>
                        #{{ $reservation->id }} - {{ $reservation->customer_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.general.amount') }}</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.general.payment_method') }}</label>
            <input type="text" name="payment_method" value="{{ old('payment_method') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.forms.payment_method_ar') }}</label>
            <input type="text" name="payment_method_ar" value="{{ old('payment_method_ar') }}" class="form-control" dir="rtl">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('admin.general.payment_date') }}</label>
            <input type="date" name="payment_date" value="{{ old('payment_date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('admin.general.status') }}</label>
            <select name="status" class="form-select">
                @foreach(['paid','pending','failed'] as $status)
                    <option value="{{ $status }}" @selected(old('status','paid')==$status)>{{ __('admin.payment_statuses.' . $status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ __('admin.general.reference') }}</label>
            <input type="text" name="reference" value="{{ old('reference') }}" class="form-control" placeholder="{{ __('admin.forms.receipt_reference') }}">
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ __('admin.general.save_payment') }}</button>
            <a href="{{ route('admin.payments.index', app()->getLocale()) }}" class="btn btn-secondary">{{ __('admin.general.cancel') }}</a>
        </div>
    </form>
@endsection


