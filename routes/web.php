<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\LessonController;
use App\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes — accessible without login
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pakketten', [PackageController::class, 'index'])->name('packages.index');
Route::get('/prijzen', [PackageController::class, 'prices'])->name('prices.index');

/*
|--------------------------------------------------------------------------
| Guest routes — login and student registration
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function (): void {
    Route::get('/inloggen', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/inloggen', [AuthController::class, 'login']);
    Route::get('/registreren', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registreren', [AuthController::class, 'register']);
});

Route::post('/uitloggen', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Staff routes — admin & medewerker only (auth + staff middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'staff'])->group(function (): void {
    Route::get('/lesoverzicht', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessen/nieuw', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessen', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessen/{lesson}/bewerken', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessen/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessen/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});
