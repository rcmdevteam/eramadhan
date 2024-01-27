<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('dashboard', 'DashboardController@index');
    Route::get('export', 'DashboardController@exportTransaksi');
    Route::crud('user', 'UsersCrudController');
    // Route::crud('profiles', 'ProfilesCrudController');
    // Route::crud('categories', 'CategoriesCrudController');
    // Route::crud('topics', 'TopicsCrudController');
    // Route::crud('profile-category', 'ProfileCategoryCrudController');
    // Route::crud('profile-topics', 'ProfileTopicsCrudController');
    // Route::crud('orders', 'OrdersCrudController');
    // Route::crud('order-details', 'OrderDetailsCrudController');
    // Route::crud('profile-sponsors', 'ProfileSponsorsCrudController');

    Route::impersonate();
    Route::get('user/{id}/impersonate', function ($id) {
        $user = \App\Models\User::find($id);
        Auth::user()->impersonate($user);

        return redirect(backpack_url() . '/dashboard');
    });

    Route::get('impersonate/leave', function () {
        Auth::user()->leaveImpersonation();

        return redirect(backpack_url() . '/user');
    });
    Route::crud('masjid', 'MasjidCrudController');
    Route::crud('masjid-user', 'MasjidUserCrudController');
    Route::crud('ramadhan', 'RamadhanCrudController');
    Route::crud('transaksi', 'TransaksiCrudController');
    Route::crud('lot', 'LotCrudController');
    Route::crud('system-setting', 'SystemSettingCrudController');
}); // this should be the absolute last line of this file