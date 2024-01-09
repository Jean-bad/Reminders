<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::prefix("auth")->group(function () {

    // Rutas publicar, cualquiera puede acceder
    Route::post("login", [AuthController::class, "login"]);
    Route::post("create-account", [AuthController::class, "createAccount"]);

    // Rutas pribadas. solo se puede acceder con un token
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get("me", [AuthController::class, "me"]);
        Route::patch("update-account", [AuthController::class, "updateAccount"]);
        Route::post("logout", [AuthController::class, "logout"]);
    });
});

// Para administración
Route::resource('users', UserController::class);

// Rutas privadas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('reminders', RemindersController::class);
});
