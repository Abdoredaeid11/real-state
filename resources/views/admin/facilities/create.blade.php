@extends('admin.layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Create Facility</h4>
        <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.facilities.store') }}" method="POST">
                @csrf
                @if (Auth::user()->role == 'admin')
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
                    <label class="form-label">Facility Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Enter facility name">
                    @error('name')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Save
                </button>
            </form>
        </div>
    </div>
@endsection
