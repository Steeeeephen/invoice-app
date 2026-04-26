<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Demo',
            'last_name' => 'Super Admin',
            'email' => 'demo@superadmin.com',
            'role' => 'super_admin',
            'password' => bcrypt('admin'),
        ]);

    }
}
