@extends('layouts.app')

@section('title', 'Visit Requests')
@section('page-title', 'Visit Requests')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-check me-2 text-primary"></i>All Visit Requests</span>
        <!-- Filter Pills -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.visits.index') }}"
               class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
            <a href="{{ route('admin.visits.index', ['status' => 'pending']) }}"
               class="btn btn-sm {{ request('status') === 'pending' ? 'btn-warning' : 'btn-outline-secondary' }}">Pending</a>
            <a href="{{ route('admin.visits.index', ['status' => 'approved']) }}"
               class="btn btn-sm {{ request('status') === 'approved' ? 'btn-success' : 'btn-outline-secondary' }}">Approved</a>
            <a href="{{ route('admin.visits.index', ['status' => 'rejected']) }}"
               class="btn btn-sm {{ request('status') === 'rejected' ? 'btn-danger' : 'btn-outline-secondary' }}">Rejected</a>
        </div>
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
                        <th>Time</th>
                        <th>Visitors</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                    <tr>
                        <td class="fw-semibold text-primary">{{ $req->request_number }}</td>
                        <td>{{ $req->visitor?->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->inmate?->full_name ?? 'N/A' }}</td>
                        <td>{{ $req->preferred_date->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($req->preferred_time)->format('H:i') }}</td>
                        <td>{{ $req->number_of_visitors }}</td>
                        <td>
                            <span class="status-badge status-{{ $req->status }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.visits.show', $req) }}"
                               class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i> Review
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>No visit requests found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $requests->links() }}</div>
    </div>
</div>

@endsection