<?php

use App\Modules\Client\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => ['guest:admin']], function () {
    Route::get('/login', [AuthController::class, 'loginView'])
        ->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::get('/register', [AuthController::class, 'registerView'])
        ->name('registerView');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


