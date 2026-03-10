<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\VisitRequest;
use App\Models\Inmate;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $visitor = Auth::user()->visitor;
        $requests = VisitRequest::with(['inmate', 'schedule'])
            ->where('visitor_id', $visitor?->id)
            ->latest()->paginate(10);
        return view('visitor.requests.index', compact('requests'));
    }

    public function create()
    {
        $inmates = Inmate::where('status', 'active')->get();
        return view('visitor.requests.create', compact('inmates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inmate_id'          => 'required|exists:inmates,id',
            'preferred_date'     => 'required|date|after_or_equal:today',
            'preferred_time'     => 'required',
            'relationship'       => 'required|string|max:100',
            'purpose'            => 'nullable|string',
            'number_of_visitors' => 'required|integer|min:1|max:5',
        ]);

        $visitor = Auth::user()->visitor;

        if (!$visitor) {
            return redirect()->route('visitor.profile.create')
                ->with('error', 'Please complete your visitor profile first.');
        }

        if ($visitor->is_blacklisted) {
            return back()->with('error', 'You are not allowed to submit visit requests.');
        }

        VisitRequest::create([
            'visitor_id'         => $visitor->id,
            'inmate_id'          => $request->inmate_id,
            'preferred_date'     => $request->preferred_date,
            'preferred_time'     => $request->preferred_time,
            'relationship'       => $request->relationship,
            'purpose'            => $request->purpose,
            'number_of_visitors' => $request->number_of_visitors,
            'status'             => 'pending',
        ]);

        return redirect()->route('visitor.requests.index')
            ->with('success', 'Visit request submitted successfully.');
    }

    public function show(VisitRequest $visitRequest)
    {
        $this->authorize('view', $visitRequest);
        $visitRequest->load(['inmate', 'schedule']);
        return view('visitor.requests.show', compact('visitRequest'));
    }

    public function cancel(VisitRequest $visitRequest)
    {
        $this->authorize('update', $visitRequest);

        if (!$visitRequest->isPending()) {
            return back()->with('error', 'Only pending requests can be cancelled.');
        }

        $visitRequest->update(['status' => 'cancelled']);
        return redirect()->route('visitor.requests.index')
            ->with('success', 'Visit request cancelled.');
    }
}