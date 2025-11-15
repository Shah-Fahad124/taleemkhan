<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::factory()->count(20)->create();

        School::create([
            'emis_code' => '123456',
            'school_name' => 'Bitcoderlabs pvt ltd',
            'school_level' => 'High',
            'district_id' => 1,
            'tehsil_id' => 1,
            'zone' => 'Summer Zone',
            'head_teacher_name' => 'Shah Fahad',
            'head_teacher_phone' => '0330 9520278',
            'number_of_teachers' => 10,
            'email' => 'shahfahad@gmail.com',
            'password' => bcrypt('123456'),
            'is_active' => true,
        ]);
    }
}
