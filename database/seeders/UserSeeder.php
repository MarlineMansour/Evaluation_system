<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'employee_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employee_id' => 2,
                'username' => 'sara',
                'password' => Hash::make('password123'),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employee_id' => 3,
                'username' => 'ali',
                'password' => Hash::make('pass1234'),
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'employee_id' => 4,
                'username' => 'mary',
                'password' => Hash::make('mary1234'),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);
    }
}
