<?php

namespace App\Http\Controllers;

use App\Models\Inmate;
use App\Models\Visitor;
use App\Models\VisitRequest;

class WelcomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_inmates'    => Inmate::where('status', 'active')->count(),
            'total_visitors'   => Visitor::where('is_verified', true)->count(),
            'total_requests'   => VisitRequest::count(),
            'completed_visits' => VisitRequest::where('status', 'completed')->count(),
        ];

        return view('welcome', compact('stats'));
    }
}