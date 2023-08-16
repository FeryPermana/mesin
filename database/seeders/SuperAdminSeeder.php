<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'role' => '1',
        ]);

        User::create([
            'name' => 'AMDK 1',
            'email' => 'amdksatu@gmail.com',
            'password' => Hash::make('adminamdksatu'),
            'role' => '2',
        ]);

        User::create([
            'name' => 'AMDK 2',
            'email' => 'amdkdua@gmail.com',
            'password' => Hash::make('adminamdkdua'),
            'role' => '2',
        ]);

        User::create([
            'name' => 'AMDK 3',
            'email' => 'amdktiga@gmail.com',
            'password' => Hash::make('adminamdktiga'),
            'role' => '2',
        ]);
    }
}
