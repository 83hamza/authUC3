<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'admin@uc3.dz'],
    [
        'name' => 'Super Admin',
        'is_admin' => true,
        'role' => 'super_admin',
        'password' => User::where('email','admin@uc3.dz')->exists()
            ? User::where('email','admin@uc3.dz')->first()->password
            : Hash::make('Admin@12345'),
    ]
);

    }
}
