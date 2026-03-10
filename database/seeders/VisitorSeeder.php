<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use App\Models\User;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::where('email', 'visitor@prison.rw')->first();
        $user2 = User::where('email', 'visitor2@prison.rw')->first();

        Visitor::create([
            'user_id'                 => $user1->id,
            'national_id'             => '1199800012345681',
            'first_name'              => 'Alice',
            'last_name'               => 'Uwimana',
            'date_of_birth'           => '1995-06-12',
            'gender'                  => 'female',
            'phone'                   => '+250788000004',
            'address'                 => 'Kigali, Gasabo',
            'occupation'              => 'Teacher',
            'relationship_to_inmate'  => 'Spouse',
            'is_verified'             => true,
            'is_blacklisted'          => false,
        ]);

        Visitor::create([
            'user_id'                 => $user2->id,
            'national_id'             => '1199800012345682',
            'first_name'              => 'Robert',
            'last_name'               => 'Nkurunziza',
            'date_of_birth'           => '1988-02-20',
            'gender'                  => 'male',
            'phone'                   => '+250788000005',
            'address'                 => 'Kigali, Nyarugenge',
            'occupation'              => 'Engineer',
            'relationship_to_inmate'  => 'Brother',
            'is_verified'             => false,
            'is_blacklisted'          => false,
        ]);
    }
}