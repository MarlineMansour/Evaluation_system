<?php

namespace Database\Seeders;

use App\Models\EmployeePositionHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeePositionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeePositionHistory::insert([
            [
                'employee_id' => 1,
                'position_id' => 1,
                'start_date' => '2022-01-10',
                'end_date' => null,
                'duration' => 36,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employee_id' => 2,
                'position_id' => 2,
                'start_date' => '2023-03-01',
                'end_date' => null,
                'duration' => 20,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
