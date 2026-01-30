<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@uc3.dz'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'role' => 'super_admin',
            ]
        );
    }
}

