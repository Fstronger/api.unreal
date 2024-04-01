<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'token',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/check', [AuthController::class, 'checkUser']);
    Route::post('/auth_user', [AuthController::class, 'authUser']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/factions', [AuthController::class, 'getFactions']);
    Route::get('/faction-heroes/{factionId}', [AuthController::class, 'getFactionHeroes']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
