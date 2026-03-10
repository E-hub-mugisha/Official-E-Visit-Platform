<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inmate;

class InmateSeeder extends Seeder
{
    public function run(): void
    {
        $inmates = [
            [
                'inmate_number'         => 'NP-2024-001',
                'first_name'            => 'Jean',
                'last_name'             => 'Bizimana',
                'date_of_birth'         => '1985-03-15',
                'gender'                => 'male',
                'national_id'           => '1198500011111111',
                'crime_category'        => 'Fraud',
                'admission_date'        => '2022-06-10',
                'expected_release_date' => '2027-06-10',
                'status'                => 'active',
                'cell_block'            => 'Block A',
            ],
            [
                'inmate_number'         => 'NP-2024-002',
                'first_name'            => 'Marie',
                'last_name'             => 'Mukamana',
                'date_of_birth'         => '1990-07-22',
                'gender'                => 'female',
                'national_id'           => '1199000022222222',
                'crime_category'        => 'Theft',
                'admission_date'        => '2023-01-05',
                'expected_release_date' => '2026-01-05',
                'status'                => 'active',
                'cell_block'            => 'Block B',
            ],
            [
                'inmate_number'         => 'NP-2024-003',
                'first_name'            => 'Patrick',
                'last_name'             => 'Nshimiyimana',
                'date_of_birth'         => '1978-11-30',
                'gender'                => 'male',
                'national_id'           => '1197800033333333',
                'crime_category'        => 'Assault',
                'admission_date'        => '2021-09-20',
                'expected_release_date' => '2028-09-20',
                'status'                => 'active',
                'cell_block'            => 'Block A',
            ],
            [
                'inmate_number'         => 'NP-2024-004',
                'first_name'            => 'Grace',
                'last_name'             => 'Uwineza',
                'date_of_birth'         => '1995-04-18',
                'gender'                => 'female',
                'national_id'           => '1199500044444444',
                'crime_category'        => 'Drug Trafficking',
                'admission_date'        => '2023-05-15',
                'expected_release_date' => '2030-05-15',
                'status'                => 'active',
                'cell_block'            => 'Block C',
            ],
            [
                'inmate_number'         => 'NP-2024-005',
                'first_name'            => 'Emmanuel',
                'last_name'             => 'Hakizimana',
                'date_of_birth'         => '1982-08-05',
                'gender'                => 'male',
                'national_id'           => '1198200055555555',
                'crime_category'        => 'Robbery',
                'admission_date'        => '2020-03-12',
                'expected_release_date' => '2025-03-12',
                'status'                => 'active',
                'cell_block'            => 'Block B',
            ],
        ];

        foreach ($inmates as $inmate) {
            Inmate::create($inmate);
        }
    }
}