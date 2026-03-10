<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitRequest;
use App\Models\VisitSchedule;
use App\Models\VisitNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $query = VisitRequest::with(['visitor', 'inmate'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(15);
        return view('admin.visits.index', compact('requests'));
    }

    public function show(VisitRequest $visitRequest)
    {
        $visitRequest->load(['visitor.user', 'inmate', 'schedule', 'reviewer']);
        return view('admin.visits.show', compact('visitRequest'));
    }

    public function approve(Request $request, VisitRequest $visitRequest)
    {
        $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required',
            'end_time'       => 'required',
            'visit_room'     => 'nullable|string',
            'admin_notes'    => 'nullable|string',
        ]);

        $visitRequest->update([
            'status'      => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'admin_notes' => $request->admin_notes,
        ]);

        VisitSchedule::create([
            'visit_request_id' => $visitRequest->id,
            'scheduled_date'   => $request->scheduled_date,
            'scheduled_time'   => $request->scheduled_time,
            'end_time'         => $request->end_time,
            'visit_room'       => $request->visit_room,
        ]);

        VisitNotification::create([
            'user_id'          => $visitRequest->visitor->user_id,
            'visit_request_id' => $visitRequest->id,
            'title'            => 'Visit Request Approved',
            'message'          => 'Your visit request has been approved. Please check your schedule.',
            'type'             => 'approval',
        ]);

        return redirect()->route('admin.visits.index')
            ->with('success', 'Visit request approved and scheduled.');
    }

    public function reject(Request $request, VisitRequest $visitRequest)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $visitRequest->update([
            'status'           => 'rejected',
            'reviewed_by'      => Auth::id(),
            'reviewed_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        VisitNotification::create([
            'user_id'          => $visitRequest->visitor->user_id,
            'visit_request_id' => $visitRequest->id,
            'title'            => 'Visit Request Rejected',
            'message'          => 'Your visit request has been rejected. Reason: ' . $request->rejection_reason,
            'type'             => 'rejection',
        ]);

        return redirect()->route('admin.visits.index')
            ->with('success', 'Visit request rejected.');
    }
}
