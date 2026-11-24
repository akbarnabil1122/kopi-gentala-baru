<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $rememberTokenName = '';

    protected $fillable = [
        'nama_admin', 'email', 'password_hash', 'mfa_enabled',
        'mfa_secret', 'failed_login_attempts', 'locked_until',
    ];
    protected $hidden = ['password_hash', 'mfa_secret'];

    protected function casts(): array
    {
        return [
            'password_hash' => 'hashed',
            'mfa_enabled' => 'boolean',
            'locked_until' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_admin');
    }
}