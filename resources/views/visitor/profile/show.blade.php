@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')

@if(!$visitor)
    <div class="alert alert-warning d-flex gap-2 align-items-center">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            You have not completed your profile yet.
            <a href="{{ route('visitor.profile.create') }}" class="fw-bold">
                Complete it now
            </a>
        </div>
    </div>
@else

<div class="row g-3">

    <!-- Profile Card -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body text-center p-4">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:90px;height:90px;background:#ede9fe">
                    <i class="bi bi-person-fill" style="font-size:3rem;color:#7c3aed"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $visitor->full_name }}</h5>
                <p class="text-muted mb-3">{{ Auth::user()->email }}</p>

                <div class="d-flex gap-2 justify-content-center mb-3">
                    @if($visitor->is_verified)
                        <span class="status-badge status-approved">
                            <i class="bi bi-patch-check me-1"></i>Verified
                        </span>
                    @else
                        <span class="status-badge status-pending">
                            <i class="bi bi-hourglass me-1"></i>Pending Verification
                        </span>
                    @endif

                    @if($visitor->is_blacklisted)
                        <span class="status-badge status-rejected">
                            <i class="bi bi-slash-circle me-1"></i>Blacklisted
                        </span>
                    @endif
                </div>

                <a href="{{ route('visitor.profile.edit') }}"
                   class="btn btn-outline-primary btn-sm px-4">
                    <i class="bi bi-pencil me-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-lines-fill me-2 text-primary"></i>Profile Information
            </div>
            <div class="card-body p-4">
                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">National ID</div>
                            <div class="fw-semibold">{{ $visitor->national_id }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Date of Birth</div>
                            <div class="fw-semibold">{{ $visitor->date_of_birth->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Gender</div>
                            <div class="fw-semibold">{{ ucfirst($visitor->gender) }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Phone</div>
                            <div class="fw-semibold">{{ $visitor->phone }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Occupation</div>
                            <div class="fw-semibold">{{ $visitor->occupation ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Address</div>
                            <div class="fw-semibold">{{ $visitor->address ?? '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Registered On</div>
                            <div class="fw-semibold">{{ $visitor->created_at->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Total Visit Requests</div>
                            <div class="fw-semibold">{{ $visitor->visitRequests->count() }}</div>
                        </div>
                    </div>

                </div>

                @if($visitor->is_blacklisted)
                <div class="alert alert-danger mt-3 d-flex gap-2">
                    <i class="bi bi-slash-circle-fill flex-shrink-0 mt-1"></i>
                    <div>
                        <strong>Account Restricted:</strong> {{ $visitor->blacklist_reason }}
                    </div>
                </div>
                @endif

                @if(!$visitor->is_verified)
                <div class="alert alert-info mt-3 d-flex gap-2">
                    <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
                    <div>
                        Your profile is pending verification by prison administration.
                        You can submit visit requests but they may be held until verification.
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

</div>

@endif

@endsection