<?php

use App\Modules\Client\Cart\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', [CartController::class, 'index'])
        ->name('index');
});


