<?php

namespace Database\Seeders;

use App\Models\Resident;
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
            'id' => 1,
            'name' => 'Admin Sidesa',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'role_id' => '1'
        ]);

        User::create([
            'id' => 2,
            'name' => 'Penududk 1',
            'email' => 'penduduk@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'role_id' => '2'
        ]);

        Resident::create([
            'user_id' => 2,
            'nik' => '1234567891234567',
            'name' => 'penduduk 1',
            'gender' => 'male',
            'birth_date' => '2005-01-01',
            'birth_place' => 'semarang',
            'address' => 'semarang',
            'marital_status' => 'single'
        ]);
    }
}
