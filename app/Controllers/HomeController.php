<?php

declare(strict_types=1);

namespace App\Controllers;

use Illuminate\View\View;

/** Homepage with rijschool branding (public). */
class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }
}
