<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         // Generate grades like "Grade 1", "Grade 2", ... "Grade 12"
        static $gradeNumber = 1;

        return [
            'name' => 'Grade ' . $gradeNumber++,
        ];
    }
}
