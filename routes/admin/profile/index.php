<?php

use App\Modules\Admin\Account\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'profile'
    ],
    function () {
        Route::get('/', [AccountController::class, 'profile'])
            ->name('admin.profile.index');
        Route::post('/', [AccountController::class, 'updateProfile'])
            ->name('admin.profile.update');
        Route::post('/update-password', [AccountController::class, 'updatePassword'])
            ->name('admin.password.update');
    }
);


