@extends('layouts.app')

@section('title', 'New Visit Request')
@section('page-title', 'Submit Visit Request')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-calendar-plus me-2 text-primary"></i>New Visit Request
            </div>
            <div class="card-body p-4">
                <form action="{{ route('visitor.requests.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Select Inmate <span class="text-danger">*</span></label>
                            <select name="inmate_id" class="form-select @error('inmate_id') is-invalid @enderror" required>
                                <option value="">-- Search & Select Inmate --</option>
                                @foreach($inmates as $inmate)
                                    <option value="{{ $inmate->id }}"
                                        {{ old('inmate_id') == $inmate->id ? 'selected' : '' }}>
                                        {{ $inmate->full_name }} — {{ $inmate->inmate_number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inmate_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preferred Visit Date <span class="text-danger">*</span></label>
                            <input type="date" name="preferred_date"
                                   class="form-control @error('preferred_date') is-invalid @enderror"
                                   value="{{ old('preferred_date') }}"
                                   min="{{ now()->addDay()->format('Y-m-d') }}" required>
                            @error('preferred_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preferred Time <span class="text-danger">*</span></label>
                            <input type="time" name="preferred_time"
                                   class="form-control @error('preferred_time') is-invalid @enderror"
                                   value="{{ old('preferred_time') }}" required>
                            @error('preferred_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Relationship to Inmate <span class="text-danger">*</span></label>
                            <select name="relationship" class="form-select @error('relationship') is-invalid @enderror" required>
                                <option value="">-- Select --</option>
                                @foreach(['Spouse','Parent','Child','Sibling','Relative','Friend','Lawyer','Other'] as $rel)
                                    <option value="{{ $rel }}" {{ old('relationship') === $rel ? 'selected' : '' }}>
                                        {{ $rel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('relationship')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Number of Visitors <span class="text-danger">*</span></label>
                            <input type="number" name="number_of_visitors"
                                   class="form-control @error('number_of_visitors') is-invalid @enderror"
                                   value="{{ old('number_of_visitors', 1) }}" min="1" max="5" required>
                            @error('number_of_visitors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Purpose of Visit</label>
                            <textarea name="purpose" rows="3"
                                      class="form-control @error('purpose') is-invalid @enderror"
                                      placeholder="Briefly describe the purpose of your visit...">{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info mt-4 d-flex gap-2 align-items-start">
                        <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>Note:</strong> Your request will be reviewed by the prison administration.
                            You will be notified once a decision is made. Visiting hours are subject to availability.
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send me-1"></i> Submit Request
                        </button>
                        <a href="{{ route('visitor.requests.index') }}" class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection