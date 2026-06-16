<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::query()->create([
            'name' => 'Starter',
            'description' => 'Perfect om te beginnen met rijlessen.',
            'price' => 599.00,
            'lessons_count' => 10,
            'features' => ['10 praktijklessen', 'Online theorie materiaal', 'Persoonlijke voortgangsrapportage'],
            'is_popular' => false,
        ]);

        Package::query()->create([
            'name' => 'Compleet',
            'description' => 'Ons meest gekozen pakket voor zelfverzekerd rijden.',
            'price' => 1299.00,
            'lessons_count' => 25,
            'features' => ['25 praktijklessen', '5 theorielessen', 'Tussentijdse toets begeleiding', 'Examentraining'],
            'is_popular' => true,
        ]);

        Package::query()->create([
            'name' => 'Premium Examen',
            'description' => 'Alles inbegrepen tot aan je rijbewijs.',
            'price' => 1899.00,
            'lessons_count' => 40,
            'features' => ['40 praktijklessen', 'Onbeperkt theorie', 'Tussentijdse toets', 'Praktijkexamen', 'Faalangst begeleiding'],
            'is_popular' => false,
        ]);
    }
}
