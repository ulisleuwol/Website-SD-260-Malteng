<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GaleryVideo extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'galery_video';

    protected $fillable =
    [
        'judul',
        'slug',
        'deskripsi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',
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
      // Definisikan scope untuk pencarian di sisi user
      public function scopeSearch($query, $search)
      {
          if ($search) {
              return $query->where(function ($query) use ($search) {
                  $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%')
                      ->orWhere('created_at', 'like', '%' . $search . '%');
              });
          }
  
          return $query;
      }
}
