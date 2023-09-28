<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'sundar@codexsun.com'
        ]);
    }

    public function isEditor(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'dhaya@aaran.com',
        ]);
    }

    public function isEntry(): bool
    {
        return in_array($this->email, [
            'office@aaran.com',
            'sundar@sundar.com',

        ]);
    }
}
