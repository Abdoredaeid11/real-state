@extends('broker.layout.master')

@section('content')
<div class="doc-example">

    <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
        <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel"
            aria-labelledby="table-basic-preview-tab">
            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h4 class="mb-0">{{ __('admin.general.payments') }}</h4>
                </div>

                <form method="GET" action="{{ route('broker.payments.index', app()->getLocale()) }}" class="row g-2 mb-3">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">{{ __('admin.filters.all_status') }}</option>
                            @foreach(['paid','pending','failed'] as $status)
                                <option value="{{ $status }}" @selected(request('status')===$status)>{{ __('admin.payment_statuses.' . $status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="reservation_id" class="form-select">
                            <option value="">{{ __('admin.filters.all_reservations') ?? 'All reservations' }}</option>
                            @foreach($reservations as $reservation)
                                <option value="{{ $reservation->id }}" @selected(request('reservation_id')==$reservation->id)>
                                    #{{ $reservation->id }} - {{ $reservation->customer_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                        <a href="{{ route('broker.payments.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                    </div>
                </form>

                <table class="table mb-0 table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('admin.general.id') }}</th>
                            <th>{{ __('admin.general.reservation') }}</th>
                            <th>{{ __('admin.general.amount') }}</th>
                            <th>{{ __('admin.general.payment_method') }}</th>
                            <th>{{ __('admin.general.payment_date') }}</th>
                            <th>{{ __('admin.general.status') }}</th>
                            <th>{{ __('admin.general.created_at') }}</th>
                            <th>{{ __('admin.general.last_updated_by') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>#{{ $payment->reservation_id ?? '-' }} {{ $payment->reservation?->customer_name ? ' - '.$payment->reservation->customer_name : '' }}</td>
                                <td>${{ number_format($payment->amount, 2) }}</td>
                                <td>{{ app()->getLocale() == 'ar' ? $payment->payment_method_ar ?? $payment->payment_method : $payment->payment_method }}</td>
                                <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '-' }}</td>

                                <td>
                                    @if ($payment->status == 'paid')
                                        <span class="badge bg-label-success">{{ __('admin.payment_statuses.paid') }}</span>
                                    @elseif($payment->status == 'pending')
                                        <span class="badge bg-label-warning">{{ __('admin.payment_statuses.pending') }}</span>
                                    @else
                                        <span class="badge bg-label-danger">{{ __('admin.payment_statuses.failed') }}</span>
                                    @endif
                                </td>

                                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ $payment->updater?->name ?? '-' }}
                                    </small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

