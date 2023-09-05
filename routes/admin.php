<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

Route::namespace('admin')->group(
    function () {
        Route::group(['middleware' => ['auth:admin']], function () {
            includeRouteFiles(__DIR__.'/admin/dashboard');
            includeRouteFiles(__DIR__.'/admin/profile');
            includeRouteFiles(__DIR__.'/admin/category');
            includeRouteFiles(__DIR__.'/admin/brand');
            includeRouteFiles(__DIR__.'/admin/product');
        });
        Route::group(['prefix' => '/'],function () {
            includeRouteFiles(__DIR__.'/admin/auth/');
        });

        Route::get('/error',function () {
            return view('admin.error.index');
        })->name('admin.error');
    }
);

/*
 * Fallback Route
 */
Route::fallback(function () {
    return redirect()->route(homeRoute())->withFlashDanger(__('Đường dẫn không tồn tại trong hệ thống.'));
});
