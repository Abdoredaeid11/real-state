@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h4>Edit Room</h4>

        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- مهم --}}
                    @if(Auth::user()->role=='admin')

            <div class="mb-3">
                <label class="form-label">Branch</label>
                <select name="branch_id" class="form-select" required>
                    <option value="" disabled>Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branch->id == $room->branch_id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @else
            @endif
            <div class="mb-3">
                <label class="form-label">Room Number</label>
                <input type="text" name="room_number" class="form-control" placeholder="Enter room number"
                    value="{{ old('room_number', $room->room_number) }}">
                @error('room_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Enter room description"
                    value="{{ old('description', $room->description) }}">
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <select name="room_type_id" class="form-select">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('room_type_id', $room->room_type_id) == $type->id) selected @endif>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_type_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Facilities</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($facilities as $facility)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facility_ids[]"
                                value="{{ $facility->id }}" id="facility_{{ $facility->id }}"
                                @if (in_array($facility->id, old('facility_ids', $room->facilities->pluck('id')->toArray()))) checked @endif>
                            <label class="form-check-label" for="facility_{{ $facility->id }}">
                                {{ $facility->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('facility_ids')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Price per Night</label>
                <input type="number" name="price_per_night" class="form-control" placeholder="Enter price"
                    value="{{ old('price_per_night', $room->price_per_night) }}">
                @error('price_per_night')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="available" @if (old('status', $room->status) == 'available') selected @endif>Available</option>
                    <option value="occupied" @if (old('status', $room->status) == 'occupied') selected @endif>Occupied</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Room Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
                @error('images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex flex-wrap gap-2 mt-2">
                    @foreach ($room->images as $image)
                        <div class="position-relative d-inline-block image-container" id="image-{{ $image->id }}">
                            <img src="{{ asset('uploads/rooms/' . $image->image_path) }}" alt="Room Image"
                                class="rounded shadow-sm" width="100" height="100" style="object-fit: cover;">
                            <button type="button" class="btn btn-danger btn-sm delete-image-btn"
                                data-image-id="{{ $image->id }}" data-room-id="{{ $room->id }}"
                                style="position: absolute; top: -5px; right: -5px; border-radius: 50%; width: 25px; height: 25px; padding: 0; font-size: 0.8rem; line-height: 1; display: flex; align-items: center; justify-content: center;">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>

    </div>

    {{-- تأكد أنك تحمل jQuery و Bootstrap JS (إذا كنت تستخدم Select2) في ملف Master Layout أو قبله --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // كود Select2 (إذا كنت تستخدمه)
            // $('.select2').select2({
            //     placeholder: "Select Facilities",
            //     allowClear: true
            // });

            // كود حذف الصور باستخدام AJAX
            $('.delete-image-btn').on('click', function() {
                const imageId = $(this).data('image-id');
                const roomId = $(this).data('room-id'); // قد لا تحتاجها إذا كان الـ image_id فريد عالميا
                const $imageContainer = $('#image-' + imageId);

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: `/admin/rooms/${roomId}/images/${imageId}`, // مسار API الذي ستقوم بإنشائه
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $imageContainer.remove(); // إزالة الصورة من الـ DOM
                                alert(response.message);
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the image.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection
