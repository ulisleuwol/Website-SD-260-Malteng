<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestasi>
 */
class PrestasiFactory extends Factory
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
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'nama' => $this->faker->name(),
            'image' => '', // URL gambar acak
            'jenis' => $this->faker->name(),
            'description' => $this->faker->paragraphs(3, true),
            'date' => $this->faker->date(),
            'user_id' => $userIds[array_rand($userIds)],
        ];
    }
}
