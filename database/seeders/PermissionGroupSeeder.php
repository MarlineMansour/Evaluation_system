<?php

namespace Database\Seeders;


use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionGroup::insert([

            [
                'name' => 'Evaluation',
                'created_by'=> 1,
            ],
            [
                'name' => 'Super Admin',
                'created_by'=> 1,
            ],
            [
                'name' => 'Accounting',
                'created_by'=> 1,
            ],
        ]);

    }
}
