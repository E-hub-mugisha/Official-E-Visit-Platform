<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inmate;
use Illuminate\Http\Request;

class InmateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $inmates = Inmate::latest()->paginate(15);
        return view('admin.inmates.index', compact('inmates'));
    }

    public function create()
    {
        return view('admin.inmates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'inmate_number'         => 'required|unique:inmates',
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'date_of_birth'         => 'required|date',
            'gender'                => 'required|in:male,female',
            'national_id'           => 'nullable|unique:inmates',
            'crime_category'        => 'required|string',
            'admission_date'        => 'required|date',
            'expected_release_date' => 'nullable|date|after:admission_date',
            'cell_block'            => 'nullable|string',
            'notes'                 => 'nullable|string',
        ]);

        Inmate::create($request->all());

        return redirect()->route('admin.inmates.index')
            ->with('success', 'Inmate added successfully.');
    }

    public function show(Inmate $inmate)
    {
        $inmate->load(['visitRequests.visitor', 'visitRequests.schedule']);
        return view('admin.inmates.show', compact('inmate'));
    }

    public function edit(Inmate $inmate)
    {
        return view('admin.inmates.edit', compact('inmate'));
    }

    public function update(Request $request, Inmate $inmate)
    {
        $request->validate([
            'inmate_number'         => 'required|unique:inmates,inmate_number,' . $inmate->id,
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'date_of_birth'         => 'required|date',
            'gender'                => 'required|in:male,female',
            'national_id'           => 'nullable|unique:inmates,national_id,' . $inmate->id,
            'crime_category'        => 'required|string',
            'admission_date'        => 'required|date',
            'expected_release_date' => 'nullable|date|after:admission_date',
            'status'                => 'required|in:active,released,transferred',
            'cell_block'            => 'nullable|string',
            'notes'                 => 'nullable|string',
        ]);

        $inmate->update($request->all());

        return redirect()->route('admin.inmates.index')
            ->with('success', 'Inmate updated successfully.');
    }

    public function destroy(Inmate $inmate)
    {
        $inmate->delete();
        return redirect()->route('admin.inmates.index')
            ->with('success', 'Inmate deleted successfully.');
    }
}