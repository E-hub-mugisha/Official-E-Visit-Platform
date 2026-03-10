@extends('layouts.app')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')

@section('content')

<div class="row g-3">

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body p-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:70px;height:70px;background:#dbeafe">
                    <i class="bi bi-clock-history text-primary" style="font-size:2rem"></i>
                </div>
                <h5 class="fw-bold">Visit History</h5>
                <p class="text-muted small">View all visit requests filtered by status, date range and inmate.</p>
                <a href="{{ route('admin.reports.visit-history') }}" class="btn btn-primary px-4">
                    View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body p-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:70px;height:70px;background:#dcfce7">
                    <i class="bi bi-people text-success" style="font-size:2rem"></i>
                </div>
                <h5 class="fw-bold">Visitor Report</h5>
                <p class="text-muted small">View all registered visitors, their verification status and visit counts.</p>
                <a href="{{ route('admin.reports.visitors') }}" class="btn btn-success px-4">
                    View Report
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body p-4 text-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:70px;height:70px;background:#fef9c3">
                    <i class="bi bi-calendar-week text-warning" style="font-size:2rem"></i>
                </div>
                <h5 class="fw-bold">Schedule Report</h5>
                <p class="text-muted small">View visit schedules by date with check-in and check-out status.</p>
                <a href="{{ route('admin.reports.schedules') }}" class="btn btn-warning px-4">
                    View Report
                </a>
            </div>
        </div>
    </div>

</div>

@endsection