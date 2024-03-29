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
            Route::prefix("{task}")->group(function () {
                Route::get("/", [TaskController::class, "show"]);
                Route::prefix("comments")->controller(CommentController::class)->group(function () {
                    Route::post("/", "store");
                    Route::put("/{comment}", "update");
                    Route::delete("/{comment}", "destroy");
                    Route::post("/{comment}/files", "storeFile");
                    Route::delete("/{comment}/files/{file}", "destroyFile");
                });
            });
        });
        Route::get("/projects", [ProjectController::class, "index"]);
        Route::get("/projects/{project}", [ProjectController::class, "show"]);
    });
    Route::middleware("ability:role-admin")->group(function () {
        Route::prefix("tasks")->group(function () {
            Route::controller(TaskController::class)->group(function () {
                Route::post("/", "store");
                Route::prefix("{task}")->group(function () {
                    Route::put("/", "update");
                    Route::delete("/", "destroy");
                    Route::post("/files", "storeFile");
                    Route::delete("/files/{file}", "destroyFile");
                });
            });
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
