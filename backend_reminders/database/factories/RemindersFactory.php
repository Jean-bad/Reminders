<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reminders>
 */
class RemindersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Daily', 'Weekly', 'Monthly', 'Yearly'];
        return [
            'Title' => fake()->jobTitle(),
            'Description' => fake()->text(30),
            'Reminder_date' => fake()->date(),
            'Recurrence' => fake()->randomElement($types),
        ];
    }
}
