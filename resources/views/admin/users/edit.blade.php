@extends('admin.layout.master')
@section('content')
    <h4>{{ __('admin.general.edit_user') }}</h4>

    <form action="{{ route('admin.users.update', ['locale' => app()->getLocale(), 'id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT') {{-- مهم لتحديث البيانات --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.name') }}</label>
            <input type="text" name="name" class="form-control" placeholder="{{ __('admin.forms.enter_name') }}"
                value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" placeholder="{{ __('admin.forms.name_ar') }}"
                value="{{ old('name_ar', $user->name_ar) }}" dir="rtl">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="{{ __('admin.forms.enter_email') }}"
                value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.password') }} ({{ __('admin.general.password_hint') }})</label>
            <input type="password" name="password" class="form-control" placeholder="{{ __('admin.forms.enter_new_password') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.role') }}</label>
            <select name="role" class="form-select">
                @foreach($roles as $key => $label)
                    <option value="{{ $key }}" @selected(old('role', $user->role) == $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admin.general.update_user') }}</button>
    </form>
@endsection
