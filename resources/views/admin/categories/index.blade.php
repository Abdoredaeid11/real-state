@extends('admin.layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>{{ __('admin.general.categories') }}</h4>
    <a href="{{ route('admin.categories.create', app()->getLocale()) }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> {{ __('admin.general.create') }}
    </a>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('admin.general.id') }}</th>
                    <th>{{ __('admin.forms.image') }}</th>
                    <th>{{ __('admin.forms.name') }}</th>
                    <th>{{ __('admin.general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="50" class="rounded">
                        @else
                            <span class="text-muted">{{ __('admin.general.no_image') }}</span>
                        @endif
                    </td>
                    <td>{{ app()->getLocale() == 'ar' ? $category->name_ar ?? $category->name : $category->name }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.categories.edit', ['locale' => app()->getLocale(), 'id' => $category->id]) }}">
                                    <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                </a>
                                <form action="{{ route('admin.categories.destroy', ['locale' => app()->getLocale(), 'id' => $category->id]) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('{{ __('admin.general.confirm_delete') }}')">
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
    </div>
</div>
@endsection
