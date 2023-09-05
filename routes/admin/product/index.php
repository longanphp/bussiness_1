<?php

use App\Modules\Admin\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'products'
    ],
    function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('admin.products.index');

        Route::post('/', [ProductController::class, 'handle'])
            ->name('admin.products.handle');

        Route::get('/create', [ProductController::class, 'create'])
            ->name('admin.products.create');

        Route::get('/{product}', [ProductController::class, 'show'])
            ->name('admin.products.show');

        Route::post('/{product}', [ProductController::class, 'updateStatus'])
            ->name('admin.products.updateStatus');

        Route::delete('/{product}', [ProductController::class, 'delete'])
            ->name('admin.products.delete');
    }
);


