<?php

namespace App\Modules\Admin\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }
}
