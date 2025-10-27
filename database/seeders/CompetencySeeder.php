<?php

namespace Database\Seeders;

use App\Models\Competency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competency::insert([
            [
                'name_en' => 'Leadership',
                'name_ar' => 'القيادة',
                'department_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Teamwork',
                'name_ar' => 'العمل الجماعي',
                'department_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
