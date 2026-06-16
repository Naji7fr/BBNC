<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Package;
use Illuminate\View\View;

/**
 * Public pages for students: rijles pakketten and losse prijzen.
 */
class PackageController extends Controller
{
    /** Pakketten from database, sorted by price. */
    public function index(): View
    {
        $packages = Package::query()->orderBy('price')->get();

        return view('pakketten', compact('packages'));
    }

    /**
     * Individual lesson prices (static list for now).
     * Could be moved to a database table later.
     */
    public function prices(): View
    {
        $prices = [
            ['name' => 'Theorieles (per uur)', 'price' => 35.00, 'description' => 'Klassikale theorie in modern lokaal'],
            ['name' => 'Praktijkles (per uur)', 'price' => 52.50, 'description' => 'Rijden met gecertificeerde instructeur'],
            ['name' => 'Proefles', 'price' => 29.00, 'description' => 'Kennismakingsles van 60 minuten'],
            ['name' => 'Tussentijdse toets', 'price' => 220.00, 'description' => 'Begeleiding en gebruik lesauto'],
            ['name' => 'Praktijkexamen', 'price' => 265.00, 'description' => 'Examenbegeleiding inclusief lesauto'],
            ['name' => 'Faalangst examen', 'price' => 310.00, 'description' => 'Extra begeleiding bij examennervositeit'],
        ];

        return view('prijzen', compact('prices'));
    }
}
