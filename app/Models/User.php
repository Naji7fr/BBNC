<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Authenticated user with role-based access (admin, medewerker, student).
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    /** Check if user has admin role. */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    /** Check if user has medewerker role. */
    public function isMedewerker(): bool
    {
        return $this->role === UserRole::Medewerker;
    }

    /** Check if user is a registered student. */
    public function isStudent(): bool
    {
        return $this->role === UserRole::Student;
    }

    /** Admin and medewerker can access lesson management (les inplannen). */
    public function isStaff(): bool
    {
        return $this->isAdmin() || $this->isMedewerker();
    }
}
