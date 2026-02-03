@extends('admin.layout.master')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4>Create Guest</h4>

    <form action="{{ route('admin.guests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter guest name">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter guest email">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter guest phone">
        </div>

        <div class="mb-3">
            <label class="form-label">National ID</label>
            <input type="text" name="national_id" class="form-control" placeholder="Enter national ID">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter address">
        </div>

        <button type="submit" class="btn btn-primary">Create Guest</button>
    </form>
</div>
@endsection

@
