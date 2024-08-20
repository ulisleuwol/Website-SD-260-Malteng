<?php

namespace Database\Factories;

use App\Models\GaleryFoto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GaleryFotoFactory extends Factory
{

    public function definition(): array
    {
        // Ambil ID dari user yang ada di database
        $judul = $this->faker->sentence();
        $userIds = [1];
        return [
            'user_id' => $userIds[array_rand($userIds)],
            'judul' => $judul,
            'slug' => Str::slug($judul),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'image' => json_encode([$this->faker->imageUrl(640, 480, 'galery-images', true)]), // URL gambar acak
        ];
    }
}
