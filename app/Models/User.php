<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'role',
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

    public function scopeFilter($query, $params)
    {
        if (@$params->search) {
            $query->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params->search . '%');
            });
        }
    }

    public function getRoleNameAttribute()
    {
        if ($this->role == 1) {
            return "superadmin";
        }

        if ($this->role == 2) {
            return "kabag";
        }

        if ($this->role == 3) {
            return "teknisi";
        }

        if ($this->role == 4) {
            return "FA/karo";
        }

        if ($this->role == 5) {
            return "Operator";
        }
    }

    public function scopeNotKabag($query)
    {
        $query->where('role', '!=', '1');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
