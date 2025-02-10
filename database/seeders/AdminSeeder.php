<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::updateOrCreate([
            'email' => 'admin@stockpoint.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password123'),
            'phone_number' => '081234567890',
            'role' => 'admin',
        ]);
    }
}
