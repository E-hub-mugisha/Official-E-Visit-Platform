@extends('layouts.app')

@section('title', 'Visit History Report')
@section('page-title', 'Visit History Report')

@section('content')

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.reports.visit-history') }}"
              class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    @foreach(['pending','approved','rejected','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">From Date</label>
                <input type="date" name="from_date" class="form-control form-control-sm"
                       value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">To Date</label>
                <input type="date" name="to_date" class="form-control form-control-sm"
                       value="{{ request('to_date') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('admin.reports.visit-history') }}"
                   class="btn btn-outline-secondary btn-sm flex-fill">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2 text-primary"></i>Visit History</span>
        <span class="badge bg-secondary">{{ $requests->total() }} records</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Request #</th>
                        <th>Visitor</th>
                        <th>Inmate</th>
                        <th>Preferred Date</th>
                        <th>Relationship</th>
                        <th>Visitors</th>
                        <th>Status</th>
                        <th>Reviewed By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                    <tr>
                        <td class="fw-semibold text-primary">
                            <a href="{{ route('admin.visits.show', $req) }}"
                               class="text-decoration-none">
                                {{ $req->request_number }}
                            </a>
                        </td>
                        <td>{{ $req->visitor?->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->inmate?->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->preferred_date->format('d M Y') }}</td>
                        <td>{{ $req->relationship }}</td>
                        <td>{{ $req->number_of_visitors }}</td>
                        <td>
                            <span class="status-badge status-{{ $req->status }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>{{ $req->reviewer?->name ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No records found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $requests->withQueryString()->links() }}</div>
    </div>
</div>

@endsection