<?php

namespace Database\Seeders;

use App\Models\Role;
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
            'name' => 'Admin Sidesa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'role_id' => '1'
        ]);
    }
}
