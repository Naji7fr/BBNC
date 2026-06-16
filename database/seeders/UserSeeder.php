<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin BBNC',
            'email' => 'admin@bbnc.nl',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
        ]);

        User::query()->create([
            'name' => 'Medewerker BBNC',
            'email' => 'medewerker@bbnc.nl',
            'password' => Hash::make('password'),
            'role' => UserRole::Medewerker,
        ]);
    }
}
