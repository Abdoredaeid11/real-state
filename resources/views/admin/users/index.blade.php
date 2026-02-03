@extends('admin.layout.master')

@section('content')
    <div class="doc-example">
        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel"
                aria-labelledby="table-basic-preview-tab">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h4 class="mb-0">{{ __('admin.general.users') }}</h4>
                        <a href="{{ route('admin.users.create', app()->getLocale()) }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> {{ __('admin.general.create_user') }}
                        </a>
                    </div>

                    <form method="GET" action="{{ route('admin.users.index', app()->getLocale()) }}" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('admin.filters.search_user') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-select">
                                <option value="">{{ __('admin.filters.all_roles') }}</option>
                                @foreach($roles as $key => $label)
                                    <option value="{{ $key }}" @selected(request('role')===$key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('admin.general.filter') }}</button>
                            <a href="{{ route('admin.users.index', app()->getLocale()) }}" class="btn btn-outline-secondary">{{ __('admin.general.reset') }}</a>
                        </div>
                    </form>

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">{{ __('admin.general.id') }}</th>
                                <th style="width: 200px;">{{ __('admin.general.name') }}</th>
                                <th style="width: 250px;">{{ __('admin.general.email') }}</th>
                                <th style="width: 150px;">{{ __('admin.general.role') }}</th>
                                <th style="width: 150px;">{{ __('admin.general.created_at') }}</th>
                                <th style="width: 100px;">{{ __('admin.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-label-secondary text-uppercase">{{ $user->role }}</span>
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.users.edit', ['locale' => app()->getLocale(), 'id' => $user->id]) }}">
                                                <i class="icon-base bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                            </a>
                                            @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', ['locale' => app()->getLocale(), 'id' => $user->id]) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('{{ __('admin.general.are_you_sure') }}')">
                                                    <i class="icon-base bx bx-trash me-1"></i> {{ __('admin.general.delete') }}
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
