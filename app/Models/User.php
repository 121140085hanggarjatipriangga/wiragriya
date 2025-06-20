<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\GajiKaryawan;
use App\Models\IjinKaryawan;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'id_karyawan',
        'role',
        'enc_password',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeHasKaryawan($query)
    {
        return $query->whereHas('roles', function($query){
            $query->where('name', 'karyawan');
        });
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_karyawan', 'id');
    }

    public function karyawan(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'id_karyawan', 'id');
    }

    public function gajiKaryawan(): HasMany
    {
        return $this->hasMany(GajiKaryawan::class, 'id_karyawan', 'id');
    }

    public function absen(): HasMany
    {
        return $this->hasMany(Absen::class, 'id_karyawan', 'id');
    }

    public function ijinKaryawan(): HasMany
    {
        return $this->hasMany(IjinKaryawan::class, 'id_karyawan', 'id');
    }
}
