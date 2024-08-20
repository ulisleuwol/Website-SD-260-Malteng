<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sejarah extends Model
{
    use HasFactory;

    protected $table = 'sejarah';

    protected $fillable = ['title', 'slug', 'image', 'excerpt', 'deskripsi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title) . '-' . Str::uuid();
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title) . '-' . Str::uuid();
            }
        });
    }
}
