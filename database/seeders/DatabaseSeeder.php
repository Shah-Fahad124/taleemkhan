<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
  public function run(): void
{
    $this->call([
        DistrictSeeder::class,
        TehsilSeeder::class,
        GradeSeeder::class,
        SchoolSeeder::class,
        SubjectSeeder::class,
        StudentSeeder::class,
        AdminSeeder::class,
        ItemBankSeeder::class,
    ]);
}
}
