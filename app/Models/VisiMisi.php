<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misi';

    protected $fillable = ['jenis', 'slug', 'deskripsi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->jenis) . '-' . Str::uuid();
        });

        static::updating(function ($model) {
            if ($model->isDirty('jenis')) {
                $model->slug = Str::slug($model->jenis) . '-' . Str::uuid();
            }
        });
    }
}
