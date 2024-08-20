<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'pengumuman';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'file'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
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
                  $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('excerpt', 'like', '%' . $search . '%')
                      ->orWhere('body', 'like', '%' . $search . '%')
                      ->orWhere('created_at', 'like', '%' . $search . '%');
              });
          }
  
          return $query;
      }
}
