@extends('admin.layout.master')
@section('content')
    <div class="doc-example">
        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel"
                aria-labelledby="table-basic-preview-tab">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ __('admin.general.properties') }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.properties.create', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> {{ __('admin.general.create') }} {{ __('admin.general.properties') }}
                            </a>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('admin.properties.index', app()->getLocale()) }}" class="row g-2 mb-3">
                        <div class="col-md-3">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('admin.filters.search_placeholder') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="type" class="form-select">
                                <option value="">{{ __('admin.filters.all_types') }}</option>
                                <option value="sale" @selected(request('type')==='sale')>{{ __('admin.property_types_enum.sale') }}</option>
                                <option value="rent" @selected(request('type')==='rent')>{{ __('admin.property_types_enum.rent') }}</option>
                                <option value="invest" @selected(request('type')==='invest')>{{ __('admin.property_types_enum.invest') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-select">
                                <option value="">{{ __('admin.filters.all_status') }}</option>
                                @foreach(['available','pending','sold','rented','off_market'] as $status)
                                    <option value="{{ $status }}" @selected(request('status')===$status)>{{ __('admin.property_statuses.' . $status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="property_type_id" class="form-select">
                                <option value="">{{ __('admin.filters.all_property_types') }}</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" @selected(request('property_type_id')==$type->id)>{{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}</option>
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
                        <div class="col-md-2">
                            <select name="user_id" class="form-select">
                                <option value="">{{ __('admin.filters.all_users') ?? 'All users' }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @selected(request('user_id')==$user->id)>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="city" value="{{ request('city') }}" class="form-control" placeholder="{{ __('admin.forms.city') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" step="0.01" name="price_min" value="{{ request('price_min') }}" class="form-control" placeholder="{{ __('admin.filters.min_price') }}">
                        </div>
                            <div class="col-md-2">
                            <input type="number" step="0.01" name="price_max" value="{{ request('price_max') }}" class="form-control" placeholder="{{ __('admin.filters.max_price') }}">
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                            <a href="{{ route('admin.properties.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                        </div>
                    </form>

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('admin.general.id') }}</th>
                                <th>{{ __('admin.forms.title') }}</th>
                                <th>{{ __('admin.forms.description') }}</th>
                                <th>{{ __('admin.forms.images') }}</th>
                                <th>{{ __('admin.forms.price') }}</th>
                                <th>{{ __('admin.forms.type') }}</th>
                                <th>{{ __('admin.general.status') }}</th>
                                <th>{{ __('admin.forms.property_type') }}</th>
                                <th>{{ __('admin.general.category') }}</th>
                                <th>{{ __('admin.forms.city') }}</th>
                                <th>{{ __('admin.forms.address') }}</th>
                                <th>{{ __('admin.forms.bedrooms') }}</th>
                                <th>{{ __('admin.forms.bathrooms') }}</th>
                                <th>{{ __('admin.forms.area') }}</th>
                                <th>{{ __('admin.forms.broker') }}</th>
                                <th>{{ __('admin.general.created_at') }}</th>
                                <th>{{ __('admin.general.updated_at') }}</th>
                                <th>{{ __('admin.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->id }}</td>
                                    <td>{{ app()->getLocale() == 'ar' ? $property->title_ar ?? $property->title : $property->title }}</td>
                                    <td
                                        style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ app()->getLocale() == 'ar' ? $property->description_ar ?? $property->description : $property->description }}
                                    </td>
                                    <td>
                                        @if ($property->images && $property->images->count() > 0)
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#propertyImagesModal{{ $property->id }}">
                                                {{ __('admin.general.view_images') }}
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="propertyImagesModal{{ $property->id }}"
                                                tabindex="-1" aria-labelledby="propertyImagesModalLabel{{ $property->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="propertyImagesModalLabel{{ $property->id }}">{{ __('admin.general.property_images') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex flex-wrap gap-2">
                                                            @foreach ($property->images as $img)
                                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                                    alt="Property Image" class="img-thumbnail"
                                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>${{ number_format($property->price, 2) }}</td>
                                    <td>{{ ucfirst($property->type) }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'available' => 'success',
                                                'pending' => 'warning',
                                                'sold' => 'danger',
                                                'rented' => 'primary',
                                                'off_market' => 'secondary',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$property->status] ?? 'secondary' }}">
                                            {{ ucfirst(str_replace('_',' ',$property->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $property->type?->name ?? '-' }}</td>
                                    <td>{{ app()->getLocale() == 'ar' ? $property->category?->name_ar ?? $property->category?->name : $property->category?->name ?? '-' }}</td>
                                    <td>{{ $property->city }}</td>
                                    <td>{{ $property->address }}</td>
                                    <td>{{ $property->bedrooms }}</td>
                                    <td>{{ $property->bathrooms }}</td>
                                    <td>{{ $property->area }}</td>
                                    <td>{{ $property->broker?->name ?? '-' }}</td>
                                    <td>{{ $property->created_at?->format('Y-m-d') }}</td>
                                    <td>{{ $property->updated_at?->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($property->status === 'pending')
                                                    <form action="{{ route('admin.properties.approve', ['locale' => app()->getLocale(), 'id' => $property->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="dropdown-item text-success">
                                                            <i class="bx bx-check me-1"></i> {{ __('admin.general.approve') }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.properties.reject', ['locale' => app()->getLocale(), 'id' => $property->id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('{{ __('admin.general.are_you_sure') }}')">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="bx bx-x me-1"></i> {{ __('admin.general.reject') }}
                                                        </button>
                                                    </form>
                                                    <hr class="dropdown-divider">
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.properties.edit', ['locale' => app()->getLocale(), 'id' => $property->id]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                                </a>
                                                <form action="{{ route('admin.properties.destroy', ['locale' => app()->getLocale(), 'id' => $property->id]) }}"
                                                    method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">
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
                        {{ $properties->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
