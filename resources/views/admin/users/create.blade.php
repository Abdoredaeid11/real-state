@extends('admin.layout.master')

@section('content')
    <h4>{{ __('admin.general.create_user') }}</h4>

    <form action="{{ route('admin.users.store', app()->getLocale()) }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.name') }}</label>
            <input type="text" name="name" class="form-control" placeholder="{{ __('admin.forms.enter_name') }}" value="{{ old('name') }}" required>
        </div>

        {{-- Name AR --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.forms.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" placeholder="{{ __('admin.forms.name_ar') }}" value="{{ old('name_ar') }}" dir="rtl">
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="{{ __('admin.forms.enter_email') }}" value="{{ old('email') }}" required>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.password') }}</label>
            <input type="password" name="password" class="form-control" placeholder="{{ __('admin.forms.enter_password') }}" required>
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label class="form-label">{{ __('admin.general.role') }}</label>
            <select name="role" class="form-select">
                @foreach($roles as $key => $label)
                    <option value="{{ $key }}" @selected(old('role')===$key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admin.general.create_user') }}</button>
    </form>
@endsection
