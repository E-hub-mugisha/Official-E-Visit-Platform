<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitRequest;
use App\Models\VisitSchedule;
use App\Models\Visitor;
use App\Models\Inmate;
use App\Models\User;

class VisitRequestSeeder extends Seeder
{
    public function run(): void
    {
        $visitor1 = Visitor::where('national_id', '1199800012345681')->first();
        $visitor2 = Visitor::where('national_id', '1199800012345682')->first();
        $inmate1  = Inmate::where('inmate_number', 'NP-2024-001')->first();
        $inmate2  = Inmate::where('inmate_number', 'NP-2024-002')->first();
        $inmate3  = Inmate::where('inmate_number', 'NP-2024-003')->first();
        $admin    = User::where('role', 'admin')->first();

        // Approved request with schedule
        $req1 = VisitRequest::create([
            'visitor_id'         => $visitor1->id,
            'inmate_id'          => $inmate1->id,
            'preferred_date'     => now()->addDays(2)->format('Y-m-d'),
            'preferred_time'     => '09:00:00',
            'relationship'       => 'Spouse',
            'purpose'            => 'Family visit',
            'status'             => 'approved',
            'reviewed_by'        => $admin->id,
            'reviewed_at'        => now(),
            'number_of_visitors' => 2,
        ]);

        VisitSchedule::create([
            'visit_request_id' => $req1->id,
            'scheduled_date'   => now()->addDays(2)->format('Y-m-d'),
            'scheduled_time'   => '09:00:00',
            'end_time'         => '09:30:00',
            'visit_room'       => 'Room 1',
            'check_in_status'  => 'pending',
        ]);

        // Pending request
        VisitRequest::create([
            'visitor_id'         => $visitor1->id,
            'inmate_id'          => $inmate2->id,
            'preferred_date'     => now()->addDays(5)->format('Y-m-d'),
            'preferred_time'     => '10:00:00',
            'relationship'       => 'Friend',
            'purpose'            => 'General visit',
            'status'             => 'pending',
            'number_of_visitors' => 1,
        ]);

        // Rejected request
        VisitRequest::create([
            'visitor_id'         => $visitor2->id,
            'inmate_id'          => $inmate3->id,
            'preferred_date'     => now()->subDays(3)->format('Y-m-d'),
            'preferred_time'     => '14:00:00',
            'relationship'       => 'Brother',
            'purpose'            => 'Legal matter',
            'status'             => 'rejected',
            'reviewed_by'        => $admin->id,
            'reviewed_at'        => now()->subDays(2),
            'rejection_reason'   => 'Visitor not verified yet.',
            'number_of_visitors' => 1,
        ]);

        // Today's scheduled visit
        $req4 = VisitRequest::create([
            'visitor_id'         => $visitor2->id,
            'inmate_id'          => $inmate1->id,
            'preferred_date'     => today()->format('Y-m-d'),
            'preferred_time'     => '11:00:00',
            'relationship'       => 'Brother',
            'purpose'            => 'Family visit',
            'status'             => 'approved',
            'reviewed_by'        => $admin->id,
            'reviewed_at'        => now(),
            'number_of_visitors' => 1,
        ]);

        VisitSchedule::create([
            'visit_request_id' => $req4->id,
            'scheduled_date'   => today()->format('Y-m-d'),
            'scheduled_time'   => '11:00:00',
            'end_time'         => '11:30:00',
            'visit_room'       => 'Room 2',
            'check_in_status'  => 'pending',
        ]);
    }
}