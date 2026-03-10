<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\VisitRequest;
use App\Models\VisitNotification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $visitor = Auth::user()->visitor;

        $stats = [
            'total_requests'    => VisitRequest::where('visitor_id', $visitor?->id)->count(),
            'pending_requests'  => VisitRequest::where('visitor_id', $visitor?->id)->where('status', 'pending')->count(),
            'approved_requests' => VisitRequest::where('visitor_id', $visitor?->id)->where('status', 'approved')->count(),
            'completed_visits'  => VisitRequest::where('visitor_id', $visitor?->id)->where('status', 'completed')->count(),
        ];

        $recentRequests = VisitRequest::with(['inmate', 'schedule'])
            ->where('visitor_id', $visitor?->id)
            ->latest()->take(5)->get();

        $notifications = VisitNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->latest()->take(5)->get();

        return view('visitor.dashboard', compact('stats', 'recentRequests', 'notifications', 'visitor'));
    }
}