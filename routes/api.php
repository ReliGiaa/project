<?php

use Illuminate\Http\Request;
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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/lebih-3', [\App\Http\Controllers\Api\PresensiController::class, 'getPresensiAbsenLebih3']);
// Route::get('/presensi/lebih-3', 'PresensiController@getPresensiAbsenLebih3');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::apiResource('/karyawans', App\Http\Controllers\Api\KaryawanController::class);

Route::apiResource('/presensis', App\Http\Controllers\Api\PresensiController::class);