<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // Ambil ID dari dua user
        $userIds = [1];
        return [
            'title' => $this->faker->sentence(),
            'excerpt' => $this->faker->text(200),
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->address(),
            'date_time' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'user_id' => $userIds[array_rand($userIds)],
        ];
    }
}
