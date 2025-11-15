<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'English',
                'code' => 'SUB-EN',
                'description' => 'Covers grammar, comprehension, and writing skills.',
            ],

            [
                'name' => 'Computer Science',
                'code' => 'SUB-CS',
                'description' => 'Teaches programming, data structures, and algorithms.',
            ],
        ];

        foreach ($subjects as $subject) {
            // Insert or update safely (no duplicates)
            Subject::updateOrCreate(
                ['name' => $subject['name']], // check unique field
                [
                    'code' => $subject['code'],
                    'description' => $subject['description'],
                ]
            );
        }
    }
}
