@extends('layouts.app')

@section('title', 'Request Details')
@section('page-title', 'Visit Request Details')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-text me-2 text-primary"></i>{{ $visitRequest->request_number }}</span>
                <span class="status-badge status-{{ $visitRequest->status }}">
                    {{ ucfirst($visitRequest->status) }}
                </span>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="180">Inmate</td>
                        <td class="fw-semibold">{{ $visitRequest->inmate?->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Inmate Number</td>
                        <td>{{ $visitRequest->inmate?->inmate_number }}</td>
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
                    <tr>
                        <td class="text-muted">Submitted</td>
                        <td>{{ $visitRequest->created_at->format('d M Y H:i') }}</td>
                    </tr>

                    @if($visitRequest->isRejected())
                    <tr>
                        <td class="text-muted">Rejection Reason</td>
                        <td class="text-danger fw-semibold">{{ $visitRequest->rejection_reason }}</td>
                    </tr>
                    @endif

                    @if($visitRequest->schedule)
                    <tr><td colspan="2"><hr class="my-2"></td></tr>
                    <tr>
                        <td class="text-muted">Scheduled Date</td>
                        <td class="fw-semibold text-success">
                            {{ $visitRequest->schedule->scheduled_date->format('d M Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Scheduled Time</td>
                        <td>
                            {{ \Carbon\Carbon::parse($visitRequest->schedule->scheduled_time)->format('H:i') }}
                            — {{ \Carbon\Carbon::parse($visitRequest->schedule->end_time)->format('H:i') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Visit Room</td>
                        <td>{{ $visitRequest->schedule->visit_room ?? '—' }}</td>
                    </tr>
                    @endif
                </table>

                <div class="d-flex gap-2 mt-3">
                    @if($visitRequest->isPending())
                        <form action="{{ route('visitor.requests.cancel', $visitRequest) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to cancel this request?')">
                            @csrf
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-x-circle me-1"></i> Cancel Request
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('visitor.requests.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection