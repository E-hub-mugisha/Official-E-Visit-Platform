@extends('layouts.app')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-key me-2 text-primary"></i>Change Your Password
            </div>
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success d-flex gap-2 align-items-center">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Current Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="Enter your current password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            New Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="new_password"
                               class="form-control @error('new_password') is-invalid @enderror"
                               placeholder="Minimum 8 characters">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Confirm New Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="new_password_confirmation"
                               class="form-control"
                               placeholder="Repeat new password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection