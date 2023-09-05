<?php

use App\Modules\Admin\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'categories'
    ],
    function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('admin.categories.index');

        Route::post('/', [CategoryController::class, 'handle'])
            ->name('admin.categories.handle');

        Route::get('/create', [CategoryController::class, 'create'])
            ->name('admin.categories.create');

        Route::get('/{category}', [CategoryController::class, 'show'])
            ->name('admin.categories.show');

        Route::delete('/{category}', [CategoryController::class, 'delete'])
            ->name('admin.categories.delete');
    }
);


