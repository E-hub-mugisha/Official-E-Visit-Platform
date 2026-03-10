<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Models\VisitSchedule;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $todaysVisits = VisitSchedule::with(['visitRequest.visitor', 'visitRequest.inmate'])
            ->whereDate('scheduled_date', today())
            ->orderBy('scheduled_time')
            ->get();

        $stats = [
            'todays_total'      => $todaysVisits->count(),
            'checked_in'        => $todaysVisits->where('check_in_status', 'checked_in')->count(),
            'checked_out'       => $todaysVisits->where('check_in_status', 'checked_out')->count(),
            'pending'           => $todaysVisits->where('check_in_status', 'pending')->count(),
        ];

        return view('guard.dashboard', compact('todaysVisits', 'stats'));
    }
}