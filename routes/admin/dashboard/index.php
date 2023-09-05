<?php

use App\Modules\Admin\Dashboard\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('admin.dashboard.index');
