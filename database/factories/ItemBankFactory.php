<?php

namespace Database\Factories;


use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemBankFactory extends Factory
{

    public function definition(): array
    {
        return [
            'subject_id' => Subject::inRandomOrder()->value('id') ?? 1,
            'grade_id' => Grade::inRandomOrder()->value('id') ?? 1,
            'slo' => $this->faker->sentence(3),
             'slo_no' => 'SLO-' . Str::uuid(),
            'skill' => $this->faker->randomElement(['reading', 'lisning', 'writing', 'speaking']),
            'semester' => $this->faker->randomElement(['Fall', 'Spring']),
            'month' => $this->faker->randomElement(['January', 'February']),
            'difficulty' => $this->faker->randomElement(['Easy', 'Medium', 'Hard']),
            'category' => $this->faker->randomElement(['Knowledge', 'Practical', 'Theritical', 'Analysis']),
            'item_type' => $this->faker->randomElement(['MCQ', 'RRQ', 'ERQ']),
            'item_description' => $this->faker->sentence(10),
            'stimulus' => $this->faker->sentence(8),
            'option_a' => $this->faker->word(),
            'option_b' => $this->faker->word(),
            'option_c' => $this->faker->word(),
            'option_d' => $this->faker->word(),
            'correct_answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'possible_answers' => $this->faker->sentence(5),
            'marking_hints' => $this->faker->sentence(5),
            'rubric' => $this->faker->paragraph(1),
            'total_marks' => $this->faker->numberBetween(1, 10),
        ];
    }
}
