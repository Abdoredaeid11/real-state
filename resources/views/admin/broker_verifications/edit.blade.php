@extends('admin.layout.master')
@section('content')
    <h4>Edit Room Type</h4>

    <form action="{{ route('admin.room_types.update', $roomType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter room type name" value="{{ old('name', $roomType->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Enter description">{{ old('description', $roomType->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Max Occupancy</label>
            <input type="number" name="max_occupancy" class="form-control" placeholder="Enter max occupancy" value="{{ old('max_occupancy', $roomType->max_occupancy) }}" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Update Room Type</button>
    </form>
@endsection
