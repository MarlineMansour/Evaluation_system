<?php

namespace Database\Seeders;

use App\Models\Kpi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kpi::insert([
            // ---- KPIs for Software Engineer ----
            [
                'name_en' => 'Project Completion Rate',
                'name_ar' => 'معدل إكمال المشاريع',
                'baseline' => 80,
                'is_linear' => true, // higher = better
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Bug Fix Rate',
                'name_ar' => 'معدل إصلاح الأخطاء',
                'baseline' => 95,
                'is_linear' => true, // higher = better
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Customer Complaints',
                'name_ar' => 'شكاوى العملاء',
                'baseline' => 10,
                'is_linear' => false, // lower = better
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // ---- KPIs for HR Manager ----
            [
                'name_en' => 'Employee Satisfaction Rate',
                'name_ar' => 'معدل رضا الموظفين',
                'baseline' => 75,
                'is_linear' => true, // higher = better
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Turnover Rate',
                'name_ar' => 'معدل دوران الموظفين',
                'baseline' => 15,
                'is_linear' => false, // lower = better
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name_en' => 'Training Completion Rate',
                'name_ar' => 'معدل إتمام التدريب',
                'baseline' => 80,
                'is_linear' => true, // higher = better
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);

    }
}
