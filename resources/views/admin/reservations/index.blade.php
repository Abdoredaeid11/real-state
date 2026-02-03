@extends('admin.layout.master')
@section('content')
    <div class="doc-example">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="mb-0">{{ __('admin.general.reservations') }}</h4>
            <a href="{{ route('admin.reservations.create', app()->getLocale()) }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> {{ __('admin.general.create') }}
            </a>
        </div>

        <form method="GET" action="{{ route('admin.reservations.index', app()->getLocale()) }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('admin.filters.search_reservation') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">{{ __('admin.filters.all_status') }}</option>
                    @foreach(['pending','contacted','confirmed','cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status')===$status)>{{ __('admin.reservation_statuses.' . $status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="broker_id" class="form-select">
                    <option value="">{{ __('admin.filters.all_brokers') }}</option>
                    @foreach($brokers as $broker)
                        <option value="{{ $broker->id }}" @selected(request('broker_id')==$broker->id)>{{ $broker->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="property_id" class="form-select">
                    <option value="">{{ __('admin.filters.all_properties') ?? 'All properties' }}</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" @selected(request('property_id')==$property->id)>{{ app()->getLocale() == 'ar' ? $property->title_ar ?? $property->title : $property->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                <a href="{{ route('admin.reservations.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table mb-0 table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('admin.general.id') }}</th>
                        <th>{{ __('admin.general.customer') }}</th>
                        <th>{{ __('admin.general.contact') }}</th>
                        <th>{{ __('admin.general.property') ?? 'Property' }}</th>
                        <th>{{ __('admin.forms.broker') }}</th>
                        <th>{{ __('admin.general.check_in') }}</th>
                        <th>{{ __('admin.general.check_out') }}</th>
                        <th>{{ __('admin.general.status') }}</th>
                        <th>{{ __('admin.general.expected_value') }}</th>
                        <th>{{ __('admin.general.last_updated_by') }}</th>
                        <th>{{ __('admin.general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->customer_name }}</td>
                            <td>
                                <div>{{ $reservation->customer_phone ?? '-' }}</div>
                                <small class="text-muted">{{ $reservation->customer_email ?? '' }}</small>
                            </td>
                            <td>{{ app()->getLocale() == 'ar' ? $reservation->property?->title_ar ?? $reservation->property?->title : $reservation->property?->title ?? '-' }}</td>
                            <td>{{ $reservation->broker?->name ?? '-' }}</td>
                            <td>{{ $reservation->check_in ?? '-' }}</td>
                            <td>{{ $reservation->check_out ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'pending' ? 'secondary' : ($reservation->status === 'contacted' ? 'info' : 'danger')) }}">
                                    {{ __('admin.reservation_statuses.' . $reservation->status) }}
                                </span>
                            </td>
                            <td>${{ number_format($reservation->expected_value, 2) }}</td>
                            <td>
                                <small class="text-muted">
                                    {{ $reservation->updater?->name ?? '-' }}
                                </small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.reservations.edit', ['locale' => app()->getLocale(), 'id' => $reservation->id]) }}">
                                            <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                        </a>
                                        @foreach(['pending','contacted','confirmed','cancelled'] as $status)
                                            @if($status !== $reservation->status)
                                            <form action="{{ route('admin.reservations.change-status', ['locale' => app()->getLocale(), 'id' => $reservation->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ $status }}">
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('admin.general.mark_as') }} {{ __('admin.reservation_statuses.' . $status) }}
                                                </button>
                                            </form>
                                            @endif
                                        @endforeach
                                        <form action="{{ route('admin.reservations.destroy', ['locale' => app()->getLocale(), 'id' => $reservation->id]) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">
                                                <i class="bx bx-trash me-1"></i> {{ __('admin.general.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
