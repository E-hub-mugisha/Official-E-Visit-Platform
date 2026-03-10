<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name'        => 'Super Admin',
            'email'       => 'superadmin@prison.rw',
            'national_id' => '1199800012345678',
            'phone'       => '+250788000001',
            'role'        => 'super_admin',
            'is_active'   => true,
            'password'    => Hash::make('password'),
        ]);

        // Admin
        User::create([
            'name'        => 'John Mugisha',
            'email'       => 'admin@prison.rw',
            'national_id' => '1199800012345679',
            'phone'       => '+250788000002',
            'role'        => 'admin',
            'is_active'   => true,
            'password'    => Hash::make('password'),
        ]);

        // Guard
        User::create([
            'name'        => 'Eric Habimana',
            'email'       => 'guard@prison.rw',
            'national_id' => '1199800012345680',
            'phone'       => '+250788000003',
            'role'        => 'guard',
            'is_active'   => true,
            'password'    => Hash::make('password'),
        ]);

        // Visitor 1
        User::create([
            'name'        => 'Alice Uwimana',
            'email'       => 'visitor@prison.rw',
            'national_id' => '1199800012345681',
            'phone'       => '+250788000004',
            'role'        => 'visitor',
            'is_active'   => true,
            'password'    => Hash::make('password'),
        ]);

        // Visitor 2
        User::create([
            'name'        => 'Robert Nkurunziza',
            'email'       => 'visitor2@prison.rw',
            'national_id' => '1199800012345682',
            'phone'       => '+250788000005',
            'role'        => 'visitor',
            'is_active'   => true,
            'password'    => Hash::make('password'),
        ]);
    }
}