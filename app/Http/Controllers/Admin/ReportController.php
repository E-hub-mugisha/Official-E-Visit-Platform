<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitRequest;
use App\Models\Visitor;
use App\Models\Inmate;
use App\Models\VisitSchedule;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.reports.index');
    }

    public function visitHistory(Request $request)
    {
        $query = VisitRequest::with(['visitor', 'inmate', 'schedule']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('preferred_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('preferred_date', '<=', $request->to_date);
        }

        $requests = $query->latest()->paginate(20);
        return view('admin.reports.visit-history', compact('requests'));
    }

    public function visitorReport(Request $request)
    {
        $visitors = Visitor::with(['user', 'visitRequests'])
            ->withCount('visitRequests')
            ->latest()->paginate(20);
        return view('admin.reports.visitors', compact('visitors'));
    }

    public function scheduleReport(Request $request)
    {
        $date = $request->date ?? today()->toDateString();

        $schedules = VisitSchedule::with(['visitRequest.visitor', 'visitRequest.inmate'])
            ->whereDate('scheduled_date', $date)
            ->get();

        return view('admin.reports.schedules', compact('schedules', 'date'));
    }
}