<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $visitors = Visitor::with('user')->latest()->paginate(15);
        return view('admin.visitors.index', compact('visitors'));
    }

    public function show(Visitor $visitor)
    {
        $visitor->load(['visitRequests.inmate', 'visitRequests.schedule']);
        return view('admin.visitors.show', compact('visitor'));
    }

    public function verify(Visitor $visitor)
    {
        $visitor->update(['is_verified' => true]);
        return back()->with('success', 'Visitor verified successfully.');
    }

    public function blacklist(Request $request, Visitor $visitor)
    {
        $request->validate([
            'blacklist_reason' => 'required|string',
        ]);

        $visitor->update([
            'is_blacklisted'   => true,
            'blacklist_reason' => $request->blacklist_reason,
        ]);

        return back()->with('success', 'Visitor blacklisted successfully.');
    }

    public function unblacklist(Visitor $visitor)
    {
        $visitor->update([
            'is_blacklisted'   => false,
            'blacklist_reason' => null,
        ]);

        return back()->with('success', 'Visitor removed from blacklist.');
    }
}