<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Models\VisitSchedule;
use App\Models\VisitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $schedules = VisitSchedule::with(['visitRequest.visitor', 'visitRequest.inmate'])
            ->whereDate('scheduled_date', today())
            ->orderBy('scheduled_time')
            ->get();

        return view('guard.schedules', compact('schedules'));
    }

    public function checkIn(VisitSchedule $visitSchedule)
    {
        $visitSchedule->update([
            'check_in_status' => 'checked_in',
            'checked_in_at'   => now(),
            'checked_in_by'   => Auth::id(),
        ]);

        return back()->with('success', 'Visitor checked in successfully.');
    }

    public function checkOut(Request $request, VisitSchedule $visitSchedule)
    {
        $request->validate([
            'guard_notes' => 'nullable|string',
        ]);

        $visitSchedule->update([
            'check_in_status' => 'checked_out',
            'checked_out_at'  => now(),
            'guard_notes'     => $request->guard_notes,
        ]);

        $visitSchedule->visitRequest->update(['status' => 'completed']);

        return back()->with('success', 'Visitor checked out successfully.');
    }

    public function noShow(VisitSchedule $visitSchedule)
    {
        $visitSchedule->update(['check_in_status' => 'no_show']);
        $visitSchedule->visitRequest->update(['status' => 'completed']);

        return back()->with('success', 'Marked as no show.');
    }
}