<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue !']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('user-show');
    // User middleware
    Route::middleware('isUser')->group(function () {
        Route::apiResource('todo', TodoController::class);
        Route::put('/profil', [ProfilController::class, 'update'])->name('profil-update');
    });

    Route::middleware('isAdmin')->group(function () {
        Route::post('/team', [TeamController::class, 'store'])->name('team-store');
        Route::post('/task', [TaskController::class, 'store'])->name('task-store');
    });

    Route::middleware('isLead')->group(function () {
        Route::get('/team-invitation', [TeamController::class, 'show'])->name('show-team-invitation');
        Route::post('/team-invitation', [TeamController::class, 'invite'])->name('send-team-invitation');
    });
});

// Authentication
Route::post('/auth/login', [AuthController::class, 'login'])->name('app-login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('app-register');


// Si la route n'existe pas
Route::middleware('api')->any('{any}', function (Request $request) {
    return response()->json(['message' => 'Route not found'], Response::HTTP_NOT_FOUND);
})->where('any', '.*');
