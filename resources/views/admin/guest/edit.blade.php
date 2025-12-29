@extends('admin.layout.master')
@section('content')

@extends('admin.layout.master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4>Edit Guest</h4>

    <form action="{{ route('admin.guests.update', $guest->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $guest->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $guest->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $guest->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">National ID</label>
            <input type="text" name="national_id" class="form-control" value="{{ $guest->national_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $guest->address }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Guest</button>
    </form>
</div>
@endsection

@endsection
