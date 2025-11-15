<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        // Fetch random school and grade IDs or fallback to 1
        $schoolId = School::inRandomOrder()->value('id') ?? 1;
        $gradeId  = Grade::inRandomOrder()->value('id') ?? 1;

        return [
            // Personal Info
            'full_name'                 => $this->faker->name(),
            'father_name'               => $this->faker->name('male'),
            'gender'                    => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth'             => $this->faker->date('Y-m-d', '-5 years'),
            'birth_certificate_number'  => $this->faker->unique()->numerify('BC########'),

            // Contact Info
            'current_address'           => $this->faker->address(),
            'permanent_address'         => $this->faker->address(),
            'phone_number'              => $this->faker->phoneNumber(),
            'emergency_contact'         => $this->faker->phoneNumber(),
            'section'                   => $this->faker->randomElement(['A', 'B', 'C', 'D']),

            // Academic Info
            'grade_id'                  => $gradeId,
            'status'                    => $this->faker->randomElement(['active', 'inactive', 'graduated', 'transferred']),

            // School Info
            'school_id'                 => $schoolId,
        ];
    }
}
