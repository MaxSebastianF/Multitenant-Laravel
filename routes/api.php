<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/profile', [AuthController::class, 'me'])->name('profile');
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/users', [UsersController::class, 'update']);
    Route::delete('/users', [UsersController::class, 'destroy']);
});




Route::middleware(['auth:api'])->group(function () {
    Route::get('client', [ClientController::class, 'showClient']);
    Route::get('client/services', [ClientController::class, 'services']);
    Route::get('client/suscriptions', [ClientController::class, 'suscriptions']);
    Route::get('client/suppliers', [ClientController::class, 'suppliers']);
    Route::get('client/maintenances', [ClientController::class, 'maintenances']);
});
