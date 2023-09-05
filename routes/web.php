<?php

use App\Modules\Client\Auth\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => '/',
        'as'         => 'client.',
    ],
    function () {
        includeRouteFiles(__DIR__.'/client/home');
        includeRouteFiles(__DIR__.'/client/product_client');
        includeRouteFiles(__DIR__.'/client/auth/');

        Route::group(['middleware' => ['auth:web']], function () {
            includeRouteFiles(__DIR__.'/client/cart/');
        });
    }
);

/*
 * Fallback Route
 */
//Route::fallback(function () {
//    return redirect()->route(homeRoute())->withFlashDanger(__('Đường dẫn không tồn tại trong hệ thống.'));
//});
