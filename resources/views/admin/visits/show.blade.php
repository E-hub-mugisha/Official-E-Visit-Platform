@extends('layouts.app')

@section('title', 'Review Visit Request')
@section('page-title', 'Review Visit Request')

@section('content')

<div class="row g-3">

    <!-- Request Details -->
    <div class="col-xl-5">
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-info-circle me-2 text-primary"></i>Request Details
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted">Request #</td>
                        <td class="fw-bold text-primary">{{ $visitRequest->request_number }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            <span class="status-badge status-{{ $visitRequest->status }}">
                                {{ ucfirst($visitRequest->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Visitor</td>
                        <td class="fw-semibold">{{ $visitRequest->visitor?->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Inmate</td>
                        <td class="fw-semibold">{{ $visitRequest->inmate?->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Relationship</td>
                        <td>{{ $visitRequest->relationship }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Preferred Date</td>
                        <td>{{ $visitRequest->preferred_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Preferred Time</td>
                        <td>{{ \Carbon\Carbon::parse($visitRequest->preferred_time)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">No. of Visitors</td>
                        <td>{{ $visitRequest->number_of_visitors }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Purpose</td>
                        <td>{{ $visitRequest->purpose ?? '—' }}</td>
                    </tr>
                    @if($visitRequest->reviewed_at)
                    <tr>
                        <td class="text-muted">Reviewed By</td>
                        <td>{{ $visitRequest->reviewer?->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Reviewed At</td>
                        <td>{{ $visitRequest->reviewed_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endif
                    @if($visitRequest->rejection_reason)
                    <tr>
                        <td class="text-muted">Rejection Reason</td>
                        <td class="text-danger">{{ $visitRequest->rejection_reason }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Schedule Info -->
        @if($visitRequest->schedule)
        <div class="card">
            <div class="card-header">
                <i class="bi bi-calendar-event me-2 text-success"></i>Schedule Info
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted">Scheduled Date</td>
                        <td class="fw-semibold">{{ $visitRequest->schedule->scheduled_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Time</td>
                        <td>{{ \Carbon\Carbon::parse($visitRequest->schedule->scheduled_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($visitRequest->schedule->end_time)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Room</td>
                        <td>{{ $visitRequest->schedule->visit_room ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Check-in Status</td>
                        <td>
                            <span class="status-badge status-{{ $visitRequest->schedule->check_in_status === 'checked_in' ? 'approved' : 'pending' }}">
                                {{ ucfirst(str_replace('_', ' ', $visitRequest->schedule->check_in_status)) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="col-xl-7">
        @if($visitRequest->isPending())

        <!-- Approve Form -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <i class="bi bi-check-circle me-2"></i>Approve & Schedule Visit
            </div>
            <div class="card-body">
                <form action="{{ route('admin.visits.approve', $visitRequest) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Scheduled Date <span class="text-danger">*</span></label>
                            <input type="date" name="scheduled_date" class="form-control"
                                   value="{{ $visitRequest->preferred_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Start Time <span class="text-danger">*</span></label>
                            <input type="time" name="scheduled_time" class="form-control"
                                   value="{{ $visitRequest->preferred_time }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">End Time <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Visit Room</label>
                            <input type="text" name="visit_room" class="form-control"
                                   placeholder="e.g. Room 3">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Admin Notes</label>
                            <textarea name="admin_notes" class="form-control" rows="2"
                                      placeholder="Optional notes..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 px-4">
                        <i class="bi bi-check-lg me-1"></i> Approve & Schedule
                    </button>
                </form>
            </div>
        </div>

        <!-- Reject Form -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <i class="bi bi-x-circle me-2"></i>Reject Request
            </div>
            <div class="card-body">
                <form action="{{ route('admin.visits.reject', $visitRequest) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rejection Reason <span class="text-danger">*</span></label>
                        <textarea name="rejection_reason" class="form-control" rows="3"
                                  placeholder="State the reason for rejection..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger px-4"
                            onclick="return confirm('Are you sure you want to reject this request?')">
                        <i class="bi bi-x-lg me-1"></i> Reject Request
                    </button>
                </form>
            </div>
        </div>

        @else
        <div class="card">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-check2-circle fs-1 d-block mb-3 text-success"></i>
                <h5>This request has already been <strong>{{ $visitRequest->status }}</strong>.</h5>
                <a href="{{ route('admin.visits.index') }}" class="btn btn-outline-primary mt-3">
                    Back to Requests
                </a>
            </div>
        </div>
        @endif
    </div>

</div>

@endsection