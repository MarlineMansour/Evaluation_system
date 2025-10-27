<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::insert([
            [
                'name_en' => 'Ahmed Ali',
                'name_ar' => 'أحمد علي',
                'start_date' => '2022-01-10',
                'position_id' => 1,
                'user_id' => 1,
                'manager_id' => 1,
                'department_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Sara Hassan',
                'name_ar' => 'سارة حسن',
                'start_date' => '2023-03-01',
                'position_id' => 2,
                'user_id' => 2,
                'manager_id' => 1,
                'department_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
