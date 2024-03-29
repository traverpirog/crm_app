<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
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

Route::middleware("auth:sanctum")->group(function () {
    Route::middleware(["ability:role-admin,role-user"])->group(function () {
        Route::prefix("tasks")->group(function () {
            Route::get("/", [TaskController::class, "index"]);
            Route::get("/{task}", [TaskController::class, "show"]);
            Route::post("/{task}/comments", [CommentController::class, "store"]);
            Route::put("/{task}/comments/{comment}", [CommentController::class, "update"]);
            Route::delete("/{task}/comments/{comment}", [CommentController::class, "destroy"]);
        });
        Route::get("/projects", [ProjectController::class, "index"]);
        Route::get("/projects/{project}", [ProjectController::class, "show"]);
    });
    Route::middleware("ability:role-admin")->group(function () {
        Route::prefix("tasks")->group(function () {
            Route::controller(TaskController::class)->group(function () {
                Route::post("/", "store");
                Route::put("/{task}", "update");
                Route::delete("/{task}", "destroy");
            });
            Route::post("/{task}/files", [TaskFileController::class, "store"]);
            Route::delete("/{task}/files/{file}", [TaskFileController::class, "destroy"]);
        });
        Route::prefix("projects")->controller(ProjectController::class)->group(function () {
            Route::post("/", "store");
            Route::put("/{project}", "update");
            Route::delete("/{project}", "destroy");
        });
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post("/login", "login");
    Route::post("/register", "register");
    Route::post("/logout", "logout")->middleware(["auth:sanctum"]);
});
