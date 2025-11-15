<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@sba.com',
            'password' => Hash::make('123456'),
            'phone' => '03001234567',
            'role' => 'super_admin',
        ]);
    }
}
