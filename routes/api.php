<?php

use App\Http\Controllers\TodoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['message' => 'Bienvenue !']);
});

Route::apiResource('todo', TodoController::class);



// Si la route n'existe pas
Route::middleware('api')->any('{any}', function (Request $request) {
    return response()->json(['message' => 'Route not found'], Response::HTTP_NOT_FOUND);
})->where('any', '.*');
