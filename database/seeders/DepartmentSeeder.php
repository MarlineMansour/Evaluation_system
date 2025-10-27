<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'name_en' => 'Human Resources',
                'name_ar' => 'الموارد البشرية',
                'manager_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'IT Department',
                'name_ar' => 'قسم تقنية المعلومات',
                'manager_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
