<?php

namespace Database\Factories;
use app\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tehsil>
 */
class TehsilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      // Pick a random district ID (make sure districts exist before running)
        $district = District::inRandomOrder()->first()?->id ?? 1;

        return [
            'district_id' => $district,
            'name'        => $this->faker->unique()->city(), // realistic tehsil-like names
        ];
    }
}
