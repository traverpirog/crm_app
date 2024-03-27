<?php

use App\Http\Controllers\Api\PersonalAccessTokenController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['ability:role-admin,role-user'])->group(function () {
        Route::get("/tasks", [TaskController::class, 'index']);
        Route::get("/tasks/{id}", [TaskController::class, 'show']);
        Route::get("/projects", [ProjectController::class, 'index']);
        Route::get("/projects/{id}", [ProjectController::class, 'show']);
    });
    Route::middleware('ability:role-admin')->group(function () {
        Route::prefix("tasks")->controller(TaskController::class)->group(function () {
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
        Route::resource("tasks.files", TaskFileController::class);
        Route::prefix('projects')->controller(ProjectController::class)->group(function () {
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });
});


Route::post("/personal-access-tokens", [PersonalAccessTokenController::class, 'store']);
