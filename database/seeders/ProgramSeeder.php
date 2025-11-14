<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Carbon\Carbon;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        $programs = [
            [
                'id' => 1,
                'name' => 'Senior Citizen',
                'program_type' => 'Non-Financial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Solo Parent',
                'program_type' => 'Non-Financial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Educational Assistance',
                'program_type' => 'Financial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'AIFCS',
                'program_type' => 'Financial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Program::insert($programs);
    }
}