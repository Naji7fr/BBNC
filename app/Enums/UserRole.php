<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * User roles that determine access after login.
 * Staff (admin/medewerker) see lesbeheer; students see pakketten/prijzen.
 */
enum UserRole: string
{
    case Admin = 'admin';
    case Medewerker = 'medewerker';
    case Student = 'student';

    /** Human-readable label for the navigation badge. */
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Medewerker => 'Medewerker',
            self::Student => 'Student',
        };
    }
}
