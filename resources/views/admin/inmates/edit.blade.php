@extends('layouts.app')

@section('title', 'Edit Inmate')
@section('page-title', 'Edit Inmate')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil me-2 text-warning"></i>Edit Inmate — {{ $inmate->full_name }}
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.inmates.update', $inmate) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Inmate Number <span class="text-danger">*</span></label>
                            <input type="text" name="inmate_number"
                                   class="form-control @error('inmate_number') is-invalid @enderror"
                                   value="{{ old('inmate_number', $inmate->inmate_number) }}">
                            @error('inmate_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">National ID</label>
                            <input type="text" name="national_id"
                                   class="form-control @error('national_id') is-invalid @enderror"
                                   value="{{ old('national_id', $inmate->national_id) }}">
                            @error('national_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name', $inmate->first_name) }}">
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name', $inmate->last_name) }}">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   value="{{ old('date_of_birth', $inmate->date_of_birth->format('Y-m-d')) }}">
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="male"   {{ old('gender', $inmate->gender) === 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $inmate->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Crime Category <span class="text-danger">*</span></label>
                            <input type="text" name="crime_category"
                                   class="form-control @error('crime_category') is-invalid @enderror"
                                   value="{{ old('crime_category', $inmate->crime_category) }}">
                            @error('crime_category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cell Block</label>
                            <input type="text" name="cell_block"
                                   class="form-control @error('cell_block') is-invalid @enderror"
                                   value="{{ old('cell_block', $inmate->cell_block) }}">
                            @error('cell_block')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Admission Date <span class="text-danger">*</span></label>
                            <input type="date" name="admission_date"
                                   class="form-control @error('admission_date') is-invalid @enderror"
                                   value="{{ old('admission_date', $inmate->admission_date->format('Y-m-d')) }}">
                            @error('admission_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Expected Release Date</label>
                            <input type="date" name="expected_release_date"
                                   class="form-control @error('expected_release_date') is-invalid @enderror"
                                   value="{{ old('expected_release_date', $inmate->expected_release_date?->format('Y-m-d')) }}">
                            @error('expected_release_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="active"      {{ old('status', $inmate->status) === 'active'      ? 'selected' : '' }}>Active</option>
                                <option value="released"    {{ old('status', $inmate->status) === 'released'    ? 'selected' : '' }}>Released</option>
                                <option value="transferred" {{ old('status', $inmate->status) === 'transferred' ? 'selected' : '' }}>Transferred</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Notes</label>
                            <textarea name="notes" rows="3"
                                      class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $inmate->notes) }}</textarea>
                            @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-save me-1"></i> Update Inmate
                        </button>
                        <a href="{{ route('admin.inmates.index') }}" class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection