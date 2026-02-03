@extends('admin.layout.master')
@section('content')
    @php $locale = app()->getLocale(); @endphp
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h4 class="mb-0">{{ __('admin.general.features') ?? 'Features' }}</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.features.create', $locale) }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> {{ __('admin.general.create') }}
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>{{ __('admin.general.id') }}</th>
                    <th>{{ __('admin.general.name') }}</th>
                    <th>{{ __('admin.general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($features as $feature)
                    <tr>
                        <td>{{ $feature->id }}</td>
                        <td>{{ $locale === 'ar' ? ($feature->name_ar ?? $feature->name_en) : $feature->name_en }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-outline-primary"
                                   href="{{ route('admin.features.edit', ['locale' => $locale, 'id' => $feature->id]) }}">
                                    <i class="bx bx-edit-alt me-1"></i> {{ __('admin.general.edit') }}
                                </a>
                                <form action="{{ route('admin.features.destroy', ['locale' => $locale, 'id' => $feature->id]) }}"
                                      method="POST" onsubmit="return confirm('{{ __('admin.general.are_you_sure') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-trash me-1"></i> {{ __('admin.general.delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No features</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $features->links() }}
    </div>
@endsection

