@extends('layouts.app')

@section('title', 'Visitor Details')
@section('page-title', 'Visitor Details')

@section('content')

<div class="row g-3">

    <!-- Visitor Info -->
    <div class="col-xl-4">
        <div class="card mb-3">
            <div class="card-body text-center p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:80px;height:80px;background:#ede9fe">
                    <i class="bi bi-person-fill" style="font-size:2.5rem;color:#7c3aed"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $visitor->full_name }}</h5>
                <p class="text-muted mb-2">{{ $visitor->user?->email }}</p>

                <div class="d-flex gap-2 justify-content-center mb-3">
                    @if($visitor->is_verified)
                        <span class="status-badge status-approved">Verified</span>
                    @else
                        <span class="status-badge status-pending">Unverified</span>
                    @endif

                    @if($visitor->is_blacklisted)
                        <span class="status-badge status-rejected">Blacklisted</span>
                    @endif
                </div>
            </div>

            <div class="card-body border-top">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted small">National ID</td>
                        <td class="fw-semibold">{{ $visitor->national_id }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Phone</td>
                        <td class="fw-semibold">{{ $visitor->phone }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Gender</td>
                        <td class="fw-semibold">{{ ucfirst($visitor->gender) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Date of Birth</td>
                        <td class="fw-semibold">{{ $visitor->date_of_birth->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Occupation</td>
                        <td class="fw-semibold">{{ $visitor->occupation ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Address</td>
                        <td class="fw-semibold">{{ $visitor->address ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Registered</td>
                        <td class="fw-semibold">{{ $visitor->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Admin Actions -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-shield-check me-2 text-primary"></i>Admin Actions
            </div>
            <div class="card-body d-flex flex-column gap-2">

                @if(!$visitor->is_verified)
                    <form action="{{ route('admin.visitors.verify', $visitor) }}" method="POST">
                        @csrf
                        <button class="btn btn-success w-100">
                            <i class="bi bi-patch-check me-1"></i> Verify Visitor
                        </button>
                    </form>
                @else
                    <button class="btn btn-success w-100" disabled>
                        <i class="bi bi-patch-check-fill me-1"></i> Already Verified
                    </button>
                @endif

                @if(!$visitor->is_blacklisted)
                    <button class="btn btn-outline-danger w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#blacklistModal">
                        <i class="bi bi-slash-circle me-1"></i> Blacklist Visitor
                    </button>
                @else
                    <form action="{{ route('admin.visitors.unblacklist', $visitor) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-warning w-100">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Remove Blacklist
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.visitors.index') }}"
                   class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i> Back to Visitors
                </a>
            </div>
        </div>
    </div>

    <!-- Visit History -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                Visit History
                <span class="badge bg-secondary ms-2">
                    {{ $visitor->visitRequests->count() }}
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Request #</th>
                                <th>Inmate</th>
                                <th>Date</th>
                                <th>Relationship</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($visitor->visitRequests as $req)
                            <tr>
                                <td class="fw-semibold text-primary">
                                    {{ $req->request_number }}
                                </td>
                                <td>{{ $req->inmate?->full_name ?? 'N/A' }}</td>
                                <td>{{ $req->preferred_date->format('d M Y') }}</td>
                                <td>{{ $req->relationship }}</td>
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
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox d-block fs-4 mb-2"></i>
                                    No visit history
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

<!-- Blacklist Modal -->
<div class="modal fade" id="blacklistModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-slash-circle me-2"></i>Blacklist Visitor
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.visitors.blacklist', $visitor) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger">
                        You are about to blacklist <strong>{{ $visitor->full_name }}</strong>.
                        They will not be able to submit new visit requests.
                    </div>
                    <label class="form-label fw-semibold">
                        Reason for Blacklisting <span class="text-danger">*</span>
                    </label>
                    <textarea name="blacklist_reason" class="form-control" rows="3"
                              placeholder="State the reason..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-slash-circle me-1"></i> Confirm Blacklist
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection