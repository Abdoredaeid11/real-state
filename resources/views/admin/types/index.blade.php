@extends('admin.layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>{{ __('admin.general.property_types') }}</h4>
    <a href="{{ route('admin.property-types.create', app()->getLocale()) }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> {{ __('admin.general.create') }} {{ __('admin.general.property_types') }}
    </a>
</div>

<table class="table mb-0 table-bordered table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th style="width: 80px;">{{ __('admin.general.id') }}</th>
            <th style="width: 80px;">{{ __('admin.forms.name') }}</th>
            <th style="width: 150px;">{{ __('admin.general.created_at') }}</th>
            <th style="width: 150px;">{{ __('admin.general.updated_at') }}</th>
            <th style="width: 120px;">{{ __('admin.general.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
        <tr>
            <td>{{ $type->id }}</td>
            <td>{{ app()->getLocale() == 'ar' ? $type->name_ar ?? $type->name : $type->name }}</td>
            <td>{{ $type->created_at ? $type->created_at->format('Y-m-d') : '-' }}</td>
            <td>{{ $type->updated_at ? $type->updated_at->format('Y-m-d') : '-' }}</td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.property-types.edit', ['locale' => app()->getLocale(), 'id' => $type->id]) }}">
                            <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                        </a>
                        <form action="{{ route('admin.property-types.destroy', ['locale' => app()->getLocale(), 'id' => $type->id]) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">
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
@endsection
