<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PengumumanFactory extends Factory
{

    public function definition(): array
    {
        $title = $this->faker->sentence;
         // Ambil ID dari dua user
         $userIds = [1];
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(150), // Excerpt dengan panjang 150 karakter
            'body' => $this->faker->paragraphs(5, true), // Body dengan 5 paragraf
            'user_id' => $userIds[array_rand($userIds)],
        ];
    }
}

