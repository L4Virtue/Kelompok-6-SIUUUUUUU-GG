<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role', // Pastikan 'role' sudah ada di sini[cite: 7]
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Method hasRole untuk memeriksa peran user (Sesuai Langkah 2.2 Modul Tugas)[cite: 7]
     */
    public function hasRole(...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }
}