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
        $this->app->singleton(TaskRepository::class, TaskRepositoryImpl::class);
        $this->app->singleton(FileRepository::class, FileRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
