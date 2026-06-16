<?php

declare(strict_types=1);

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protects lesbeheer routes: only admin and medewerker may pass.
 */
class EnsureStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || ! $user->isStaff()) {
            return redirect()
                ->route('login')
                ->with('error', 'Alleen admin en medewerkers hebben toegang tot lesbeheer.');
        }

        return $next($request);
    }
}
