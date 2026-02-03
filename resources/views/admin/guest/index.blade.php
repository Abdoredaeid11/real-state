@extends('admin.layout.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Guests</h4>
        <a href="{{ route('admin.guests.create', app()->getLocale()) }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Create Guest
        </a>
    </div>
    <table class="table mb-0 table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 100px;">Guest ID</th>
                <th style="width: 150px;">Name</th>
                <th style="width: 180px;">Email</th>
                <th style="width: 120px;">Phone</th>
                <th style="width: 120px;">National ID</th>
                <th style="width: 180px;">Address</th>
                <th style="width: 100px;">Created At</th>
                <th style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($guests as $guest)
                <tr>
                    <td>{{ $guest->id }}</td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->national_id ?? '-' }}</td>
                    <td>{{ $guest->address ?? '-' }}</td>
                    <td>{{ $guest->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.guests.edit', ['locale' => app()->getLocale(), 'id' => $guest->id]) }}">
                                    <i class="icon-base bx bx-edit-alt me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.guests.destroy', ['locale' => app()->getLocale(), 'id' => $guest->id]) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">
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
@endsection
