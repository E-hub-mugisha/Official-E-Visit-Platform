@extends('layouts.app')

@section('title', 'Inmate Details')
@section('page-title', 'Inmate Details')

@section('content')

<div class="row g-3">
    <!-- Inmate Info Card -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:80px;height:80px">
                    <i class="bi bi-person-fill text-white" style="font-size:2.5rem"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $inmate->full_name }}</h5>
                <p class="text-muted mb-3">{{ $inmate->inmate_number }}</p>
                <span class="status-badge
                    {{ $inmate->status === 'active'      ? 'status-approved'  : '' }}
                    {{ $inmate->status === 'released'    ? 'status-completed' : '' }}
                    {{ $inmate->status === 'transferred' ? 'status-pending'   : '' }}">
                    {{ ucfirst($inmate->status) }}
                </span>
            </div>
            <div class="card-body border-top pt-3">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted small">Gender</td>
                        <td class="fw-semibold">{{ ucfirst($inmate->gender) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Date of Birth</td>
                        <td class="fw-semibold">{{ $inmate->date_of_birth->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">National ID</td>
                        <td class="fw-semibold">{{ $inmate->national_id ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Crime</td>
                        <td class="fw-semibold">{{ $inmate->crime_category }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Cell Block</td>
                        <td class="fw-semibold">{{ $inmate->cell_block ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Admitted</td>
                        <td class="fw-semibold">{{ $inmate->admission_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Release Date</td>
                        <td class="fw-semibold">{{ $inmate->expected_release_date?->format('d M Y') ?? '—' }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-body border-top pt-3 d-flex gap-2">
                <a href="{{ route('admin.inmates.edit', $inmate) }}" class="btn btn-warning btn-sm flex-fill">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('admin.inmates.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Visit History -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history me-2 text-primary"></i>Visit History
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Request #</th>
                                <th>Visitor</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inmate->visitRequests as $req)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $req->request_number }}</td>
                                <td>{{ $req->visitor?->full_name ?? 'N/A' }}</td>
                                <td>{{ $req->preferred_date->format('d M Y') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $req->status }}">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.visits.show', $req) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox d-block fs-4 mb-2"></i>No visit history
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection