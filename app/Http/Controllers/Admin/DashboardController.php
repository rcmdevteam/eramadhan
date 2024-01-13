<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('Admin')) {
            return redirect(backpack_url('masjid/create'));
        }
        return view('vendor.backpack.ui.dashboard');
    }
}
