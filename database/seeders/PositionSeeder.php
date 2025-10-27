<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                'name_en' => 'HR Manager',
                'name_ar' => 'مدير الموارد البشرية',
                'type' => 'Competencies only',
                'is_active' => 1,
                'department_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Software Engineer',
                'name_ar' => 'مهندس برمجيات',
                'type' => 'KPIs & Competencies',
                'is_active' => 1,
                'department_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
