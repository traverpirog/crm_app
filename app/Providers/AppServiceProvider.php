<?php

namespace App\Providers;

use App\Services\FileServiceImpl;
use App\Services\Interfaces\FileService;
use App\Services\Interfaces\ProjectService;
use App\Services\Interfaces\TaskService;
use App\Services\ProjectServiceImpl;
use App\Services\TaskServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskService::class, TaskServiceImpl::class);
        $this->app->singleton(FileService::class, FileServiceImpl::class);
        $this->app->singleton(ProjectService::class, ProjectServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
