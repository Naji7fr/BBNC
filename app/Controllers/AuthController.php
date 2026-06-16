<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Handles login, student registration, and logout.
 * One login page; redirect depends on the user's role.
 */
class AuthController extends Controller
{
    /** Show the shared login form. */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Authenticate by email/password and redirect by role.
     * Staff → lesoverzicht, student → pakketten.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Onjuiste inloggegevens.']);
        }

        // Prevent session fixation after successful login.
        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();

        if ($user->isStaff()) {
            return redirect()
                ->intended(route('lessons.index'))
                ->with('success', 'Welkom, '.$user->name.'!');
        }

        return redirect()
            ->route('packages.index')
            ->with('success', 'Welkom terug, '.$user->name.'!');
    }

    /** Show student registration form. */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Create a student account and log them in immediately.
     * Only students can self-register; staff accounts are seeded.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => UserRole::Student,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('packages.index')
            ->with('success', 'Welkom bij BBNC Rijschool, '.$user->name.'!');
    }

    /** End session and return to homepage. */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Je bent uitgelogd.');
    }
}
