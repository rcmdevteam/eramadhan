<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('vendor.backpack.ui.dashboard');
    }
}
