<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inmate;
use App\Models\Visitor;
use App\Models\VisitRequest;
use App\Models\VisitSchedule;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $stats = [
            'total_inmates'        => Inmate::count(),
            'total_visitors'       => Visitor::count(),
            'pending_requests'     => VisitRequest::where('status', 'pending')->count(),
            'approved_requests'    => VisitRequest::where('status', 'approved')->count(),
            'rejected_requests'    => VisitRequest::where('status', 'rejected')->count(),
            'completed_visits'     => VisitRequest::where('status', 'completed')->count(),
            'todays_visits'        => VisitSchedule::whereDate('scheduled_date', today())->count(),
        ];

        $recentRequests = VisitRequest::with(['visitor', 'inmate'])
            ->latest()
            ->take(10)
            ->get();

        $todaysSchedules = VisitSchedule::with(['visitRequest.visitor', 'visitRequest.inmate'])
            ->whereDate('scheduled_date', today())
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'todaysSchedules'));
    }
}