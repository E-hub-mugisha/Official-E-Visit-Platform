@extends('layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-person-circle me-2 text-primary"></i>{{ $user->name }}
                </span>
                <span class="badge rounded-pill px-3
                    @if($user->role === 'super_admin') bg-danger
                    @elseif($user->role === 'admin')   bg-primary
                    @elseif($user->role === 'guard')   bg-success
                    @else                              bg-secondary
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Full Name</div>
                            <div class="fw-semibold">{{ $user->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Email</div>
                            <div class="fw-semibold">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">National ID</div>
                            <div class="fw-semibold">{{ $user->national_id ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Phone</div>
                            <div class="fw-semibold">{{ $user->phone ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Status</div>
                            <div>
                                @if($user->is_active)
                                    <span class="status-badge status-approved">Active</span>
                                @else
                                    <span class="status-badge status-rejected">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background:#f8f9fa">
                            <div class="text-muted small mb-1">Registered</div>
                            <div class="fw-semibold">
                                {{ $user->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top d-flex gap-2">
                <a href="{{ route('admin.users.edit', $user) }}"
                   class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.toggle-status', $user) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm
                            {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                            <i class="bi {{ $user->is_active ? 'bi-pause-circle' : 'bi-play-circle' }} me-1"></i>
                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-outline-secondary btn-sm ms-auto">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <!-- Reset Password -->
        @if($user->id !== auth()->id())
        <div class="card">
            <div class="card-header">
                <i class="bi bi-key me-2 text-danger"></i>Reset User Password
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   placeholder="Min 8 characters">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Confirm Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="new_password_confirmation"
                                   class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger mt-3"
                            onclick="return confirm('Reset this user password?')">
                        <i class="bi bi-key me-1"></i> Reset Password
                    </button>
                </form>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection