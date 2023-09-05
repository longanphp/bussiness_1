<?php

use App\Modules\Client\ProductClient\Http\Controllers\ProductClientController;
use Illuminate\Support\Facades\Route;

Route::get('product/{slug}', [ProductClientController::class, 'getBySlug'])
    ->name('product_client.getBySlug');
