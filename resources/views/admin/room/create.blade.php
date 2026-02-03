@extends('admin.layout.master')
@section('content')
    <h4>Create Room</h4>

    <form action="{{ route('admin.rooms.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(Auth::user()->role=='admin')
        <div class="mb-3">
            <label class="form-label">Branch</label>
            <select name="branch_id" class="form-select" required>
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        @else
        @endif
        <div class="mb-3">
            <label class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" placeholder="Enter room number">
        </div>
        <div class="mb-3">
            <label class="form-label">description</label>
            <input type="text" name="description" class="form-control" placeholder="Enter room description">
        </div>

        <div class="mb-3">
            <label class="form-label">Room Type</label>
            <select name="room_type_id" class="form-select">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Facilities</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($facilities as $facility)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="facility_ids[]" value="{{ $facility->id }}"
                            id="facility_{{ $facility->id }}">
                        <label class="form-check-label" for="facility_{{ $facility->id }}">
                            {{ $facility->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">Price per Night</label>
            <input type="number" name="price_per_night" class="form-control" placeholder="Enter price">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Room Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Create Room</button>
    </form>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Facilities",
                allowClear: true
            });
        });
    </script>
@endsection
