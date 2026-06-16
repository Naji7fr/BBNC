<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Repositories\LessonRepositoryInterface;
use App\Repositories\LessonRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bind repository interface to implementation (enables stored procedure swap).
     */
    public function register(): void
    {
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
