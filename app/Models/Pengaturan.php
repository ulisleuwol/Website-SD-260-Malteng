<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaturan extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'pengaturan';

    protected $fillable = [
        'slug',
        'nama_web',
        'telp',
        'email',
        'jam_kerja',
        'alamat',
        'deskripsi',
        'logo',
        'favicon',
        'banner',
        'background',
        'ig',
        'map',
        'akreditas',
        'youtube',
        'facebook',
        'twitter',
    ];

    // join user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_web',
                'unique' => true,
                'onUpdate' => true,
                'separator' => '-',
                'method' => function ($string, $separator) {
                    $slug = Str::slug($string, $separator);
                    // Append UUID to ensure global uniqueness
                    $slug .= '-' . Str::uuid();
                    return $slug;
                },
            ]
        ];
    }
}
