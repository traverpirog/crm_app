<?php

namespace App\Providers;

use App\Repositories\FileRepositoryImpl;
use App\Repositories\Interfaces\FileRepository;
use App\Repositories\Interfaces\TaskRepository;
use App\Repositories\TaskRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TaskRepository::class,
            TaskRepositoryImpl::class
        );
        $this->app->bind(
            FileRepository::class,
            FileRepositoryImpl::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
