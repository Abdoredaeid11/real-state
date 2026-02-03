@extends('admin.layout.master')

@section('content')
    <div class="doc-example">
        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel" aria-labelledby="table-basic-preview-tab">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ __('admin.general.agents') }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.agents.create', app()->getLocale()) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> {{ __('admin.general.create') }} {{ __('admin.general.agents') }}
                            </a>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('admin.agents.index', app()->getLocale()) }}" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('admin.filters.search_placeholder') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">{{ __('admin.filters.all_statuses') }}</option>
                                <option value="active" @selected(request('status')==='active')>Active</option>
                                <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                            <a href="{{ route('admin.agents.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                        </div>
                    </form>

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">{{ __('admin.general.id') }}</th>
                                <th style="width: 80px;">Image</th>
                                <th style="width: 200px;">{{ __('admin.general.name') }}</th>
                                <th style="width: 200px;">{{ __('admin.general.email') }}</th>
                                <th style="width: 150px;">{{ __('admin.general.phone') }}</th>
                                <th style="width: 120px;">{{ __('admin.general.status') }}</th>
                                <th style="width: 120px;">{{ __('admin.general.created_at') }}</th>
                                <th style="width: 120px;">{{ __('admin.general.updated_at') }}</th>
                                <th style="width: 100px;">{{ __('admin.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                            <tr>
                                <td>{{ $agent->id }}</td>
                                <td>
                                    <img src="{{ $agent->profile_image ? asset('storage/' . $agent->profile_image) : asset('assets/images/agents/agents1.jpg') }}"
                                         alt="image" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                                </td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->email ?? '-' }}</td>
                                <td>{{ $agent->phone ?? '-' }}</td>
                                <td>{{ ucfirst($agent->status) }}</td>
                                <td>{{ $agent->created_at ? $agent->created_at->format('Y-m-d') : '-' }}</td>
                                <td>{{ $agent->updated_at ? $agent->updated_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.agents.edit', ['locale' => app()->getLocale(), 'id' => $agent->id]) }}">
                                                <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                            </a>
                                            <form action="{{ route('admin.agents.destroy', ['locale' => app()->getLocale(), 'id' => $agent->id]) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">
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

                    <div class="mt-3">
                        {{ $agents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

