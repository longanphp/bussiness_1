<?php

use App\Modules\Admin\Brand\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'brands'
    ],
    function () {
        Route::get('/', [BrandController::class, 'index'])
            ->name('admin.brands.index');

        Route::post('/', [BrandController::class, 'handle'])
            ->name('admin.brands.handle');

        Route::get('/create', [BrandController::class, 'create'])
            ->name('admin.brands.create');

        Route::get('/{brand}', [BrandController::class, 'show'])
            ->name('admin.brands.show');

        Route::delete('/{brand}', [BrandController::class, 'delete'])
            ->name('admin.brands.delete');
    }
);


