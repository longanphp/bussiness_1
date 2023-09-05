<?php

use App\Modules\Admin\Account\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/login',
    'middleware' => ['guest:admin']
], function () {
    Route::get('/', [AccountController::class, 'loginView']);
    Route::post('/', [AccountController::class, 'login'])
        ->name('admin.login');
});

Route::get('/logout', [AccountController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');
