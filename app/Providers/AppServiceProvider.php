<?php

namespace App\Providers;

use App\Services\FileServiceImpl;
use App\Services\Interfaces\FileService;
use App\Services\Interfaces\TaskService;
use App\Services\TaskServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskService::class, TaskServiceImpl::class);
        $this->app->bind(FileService::class, FileServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
