<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GuruFactory extends Factory
{
    protected $model = Guru::class;

    public function definition(): array
    {
        // Ambil ID dari user yang ada di database
        $userIds = User::pluck('id')->toArray();
        $nama = $this->faker->name();

        return [
            'user_id' => $this->faker->randomElement($userIds), // Mengambil user_id dari user yang ada
            'nama' => $nama,
            'slug' => Str::slug($nama),
            'image' => $this->faker->imageUrl(640, 480, 'people', true, 'guru'), // URL gambar acak
            'jabatan' => $this->faker->jobTitle(),
        ];
    }
}
