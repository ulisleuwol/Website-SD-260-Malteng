<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EskulFactory extends Factory
{

    public function definition(): array
    {
        // Ambil ID dari user yang ada di database
        $userIds = [1];
        $eskul = $this->faker->words(2, true);

        return [
            'user_id' => $userIds[array_rand($userIds)],
            'eskul' => $eskul,
            'slug' => Str::slug($eskul),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->imageUrl(640, 480, 'eskul', true), // URL gambar acak
            'pendamping' => $this->faker->name(),
            'hari' => $this->faker->dayOfWeek(),
        ];
    }
}
