@extends('admin.layout.master')
@section('content')
    <div class="doc-example" bis_skin_checked="1">

        <div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example" bis_skin_checked="1">
            <div class="tab-pane fade show active" id="table-basic-preview" role="tabpanel"
                aria-labelledby="table-basic-preview-tab" bis_skin_checked="1">
                <div class="table-responsive" bis_skin_checked="1">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Rooms</h4>
                        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Create Room
                        </a>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <form method="GET" action="{{ route('admin.rooms.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="branch_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">all branc</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    @else
                    @endif

                    <table class="table mb-0 table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">#</th>

                                <th style="width: 120px;">Branch Name</th>
                                <th style="width: 120px;">Room Number</th>
                                <th style="width: 120px;">Type</th>
                                <th style="width: 180px;">Facilities</th>
                                <th style="width: 180px;">Images</th>
                                <th style="width: 100px;">Price</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td
                                        style="width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $room->branch->name }}
                                    </td>
                                    <td
                                        style="width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $room->room_number }}
                                    </td>
                                    <td
                                        style="width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $room->type->name ?? '-' }}
                                    </td>
                                    <td
                                        style="width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        @foreach ($room->facilities as $facility)
                                            <span class="badge bg-label-info">{{ $facility->name }}</span>
                                        @endforeach
                                    </td>
                                    <td style="width: 180px;">
                                        <div class="d-flex">
                                            @foreach ($room->images as $image)
                                                <img src="{{ asset('uploads/rooms/' . $image->image_path) }}"
                                                    alt="Room Image" class="rounded me-1" width="40" height="40">
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="width: 100px;">${{ $room->price_per_night }}</td>
                                    <td style="width: 100px;">
                                        @if ($room->status == 'available')
                                            <span class="badge bg-label-success">Available</span>
                                        @else
                                            <span class="badge bg-label-danger">Occupied</span>
                                        @endif
                                    </td>
                                    <td style="width: 100px;">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.rooms.edit', ['locale' => app()->getLocale(), 'id' => $room->id]) }}">
                                                    <i class="icon-base bx bx-edit-alt me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('admin.rooms.destroy', ['locale' => app()->getLocale(), 'id' => $room->id]) }}" method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="icon-base bx bx-trash me-1"></i> Delete
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

        </div>
    </div>
@endsection
