@extends('admin.layout.master')
@section('content')
    <div class="doc-example">
        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel"
                 aria-labelledby="table-basic-preview-tab">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ __('admin.general.projects') }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.projects.create', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> {{ __('admin.general.create') }} {{ __('admin.general.projects') }}
                            </a>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('admin.projects.index', app()->getLocale()) }}" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                   placeholder="{{ __('admin.filters.search_placeholder') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="type" class="form-select">
                                <option value="">{{ __('admin.filters.all_types') }}</option>
                                <option value="compound" @selected(request('type')==='compound')>Compound</option>
                                <option value="property" @selected(request('type')==='property')>Property</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">{{ __('admin.filters.all_statuses') }}</option>
                                <option value="active" @selected(request('status')==='active')>Active</option>
                                <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                            <a href="{{ route('admin.projects.index', app()->getLocale()) }}"
                               class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                        </div>
                    </form>

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">{{ __('admin.general.id') }}</th>
                            <th style="width: 220px;">{{ __('admin.general.name') }}</th>
                            <th style="width: 140px;">Type</th>
                            <th style="width: 180px;">{{ __('admin.forms.city') }}</th>
                            <th style="width: 180px;">Price From</th>
                            <th style="width: 120px;">{{ __('admin.general.status') }}</th>
                            <th style="width: 140px;">{{ __('admin.general.created_at') }}</th>
                            <th style="width: 140px;">{{ __('admin.general.updated_at') }}</th>
                            <th style="width: 120px;">{{ __('admin.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? ($project->name_ar ?: $project->name) : $project->name }}
                                    @if($project->developer)
                                        <div class="text-muted small">{{ $project->developer }}</div>
                                    @endif
                                </td>
                                <td>{{ ucfirst($project->type) }}</td>
                                <td>
                                    {{ app()->getLocale() == 'ar' ? ($project->city_ar ?: $project->city) : $project->city }}
                                </td>
                                <td>
                                    @if($project->starting_price)
                                        {{ $project->price_currency ?: 'EGP' }}
                                        {{ number_format($project->starting_price, 0) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ ucfirst($project->status) }}</td>
                                <td>{{ $project->created_at ? $project->created_at->format('Y-m-d') : '-' }}</td>
                                <td>{{ $project->updated_at ? $project->updated_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{ route('admin.projects.edit', ['locale' => app()->getLocale(), 'id' => $project->id]) }}">
                                                <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', ['locale' => app()->getLocale(), 'id' => $project->id]) }}"
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
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No projects found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $projects->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

