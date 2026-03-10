<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show()
    {
        $visitor = Auth::user()->visitor;
        return view('visitor.profile.show', compact('visitor'));
    }

    public function create()
    {
        if (Auth::user()->visitor) {
            return redirect()->route('visitor.profile.show');
        }
        return view('visitor.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id'   => 'required|string|unique:visitors,national_id',
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:today',
            'gender'        => 'required|in:male,female',
            'phone'         => 'required|string|max:20',
            'address'       => 'nullable|string|max:255',
            'occupation'    => 'nullable|string|max:100',
        ]);

        Visitor::create([
            'user_id'       => Auth::id(),
            'national_id'   => $request->national_id,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'occupation'    => $request->occupation,
            'is_verified'   => false,
            'is_blacklisted'=> false,
        ]);

        return redirect()->route('visitor.dashboard')
            ->with('success', 'Profile created successfully. Awaiting verification.');
    }

    public function edit()
    {
        $visitor = Auth::user()->visitor;
        if (!$visitor) {
            return redirect()->route('visitor.profile.create');
        }
        return view('visitor.profile.edit', compact('visitor'));
    }

    public function update(Request $request)
    {
        $visitor = Auth::user()->visitor;

        $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:today',
            'gender'        => 'required|in:male,female',
            'phone'         => 'required|string|max:20',
            'address'       => 'nullable|string|max:255',
            'occupation'    => 'nullable|string|max:100',
        ]);

        $visitor->update($request->only([
            'first_name', 'last_name', 'date_of_birth',
            'gender', 'phone', 'address', 'occupation',
        ]));

        return redirect()->route('visitor.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}