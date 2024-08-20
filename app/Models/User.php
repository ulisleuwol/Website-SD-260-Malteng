<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function agenda(): HasMany
    {
        return $this->hasMany(Agenda::class);
    }

    public function pengumuman(): HasMany
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class);
    }

    public function guru(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function visi_misi(): HasMany
    {
        return $this->hasMany(VisiMisi::class);
    }

    public function galery_video(): HasMany
    {
        return $this->hasMany(GaleryVideo::class);
    }

    public function galery_foto(): HasMany
    {
        return $this->hasMany(GaleryFoto::class);
    }

    public function pengaturan(): HasMany
    {
        return $this->hasMany(Pengaturan::class);
    }

    public function eskul(): HasMany
    {
        return $this->hasMany(Eskul::class);
    }

    public function sejarah(): HasMany
    {
        return $this->hasMany(Sejarah::class);
    }

    public function ppdb(): HasMany
    {
        return $this->hasMany(PPDB::class);
    }
}
