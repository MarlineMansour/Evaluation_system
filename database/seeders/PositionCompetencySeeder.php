<?php

namespace Database\Seeders;

use App\Models\PositionCompetency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionCompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PositionCompetency::insert([
            [
                'position_id' => 1,
                'competency_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'position_id' => 2,
                'competency_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
