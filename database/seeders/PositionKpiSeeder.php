<?php

namespace Database\Seeders;

use App\Models\PositionKPI;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionKpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PositionKpi::insert([
            // ================================
            // KPIs for Software Engineer
            // ================================
            [
                'kpi_id' => 1, // Project Completion Rate
                'position_id' => 2,
                'target' => 90,
                'weight' => 40.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'kpi_id' => 2, // Bug Fix Rate
                'position_id' => 2,
                'target' => 95,
                'weight' => 40.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'kpi_id' => 3, // Customer Complaints
                'position_id' => 2,
                'target' => 5, // fewer complaints
                'weight' => 20.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // ================================
            // KPIs for HR Manager
            // ================================
            [
                'kpi_id' => 4, // Employee Satisfaction Rate
                'position_id' => 1,
                'target' => 85,
                'weight' => 40.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'kpi_id' => 5, // Turnover Rate (lower is better)
                'position_id' => 1,
                'target' => 10,
                'weight' => 30.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'kpi_id' => 6, // Training Completion Rate
                'position_id' => 1,
                'target' => 95,
                'weight' => 30.00,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
