<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemBank;

class ItemBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 50 fake records for testing
        ItemBank::factory()->count(300)->create();
    }
}
