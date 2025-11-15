<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    public function definition(): array
    {
        return [
            'emis_code' => 'EMIS-' . $this->faker->unique()->numberBetween(1000, 9999),
            'school_name' => $this->faker->company . ' School',
            'school_level' => $this->faker->randomElement(['Primary', 'Middle', 'High']),
            'district_id' => 1, // later link with real IDs
            'tehsil_id' => 1,
            'zone' => $this->faker->randomElement(['Summer Zone', 'Winter Zone']),
            'head_teacher_name' => $this->faker->name,
            'head_teacher_phone' => $this->faker->phoneNumber,
            'number_of_teachers' => $this->faker->numberBetween(5, 25),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('123456'), // hashed password
        ];
    }
}
