@extends('admin.layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Facilities</h4>
        <a href="{{ route('admin.facilities.create', app()->getLocale()) }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Create Facility
        </a>
    </div>
    @if (Auth::user()->role == 'admin')
        <form method="GET" action="{{ route('admin.facilities.index', app()->getLocale()) }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="branch_id" class="form-control" onchange="this.form.submit()">
                        <option value="">all branc</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
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
                <th style="width: 80px;">ID</th>
                <th style="width: 120px;">Branch Name</th>

                <th style="width: 250px;">Name</th>
                <th>Description</th>
                <th style="width: 180px;">Created At</th>
                <th style="width: 120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facilities as $facility)
                <tr>
                    <td>{{ $facility->id }}</td>
                    <td style="width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $facility->branch->name }}
                    </td>
                    <td>{{ $facility->name }}</td>
                    <td style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $facility->description ?? '-' }}
                    </td>
                    <td>{{ $facility->created_at ? $facility->created_at->format('Y-m-d') : '-' }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.facilities.edit', ['locale' => app()->getLocale(), 'id' => $facility->id]) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.facilities.destroy', ['locale' => app()->getLocale(), 'id' => $facility->id]) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash me-1"></i> Delete
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
