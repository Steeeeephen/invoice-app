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
        //
        User::create([
            'first_name' => 'Stephen',
            'last_name' => 'Zalalas',
            'email' => 'szalalas@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
