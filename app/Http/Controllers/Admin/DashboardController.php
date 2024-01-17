<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Superadmin')) {
            return redirect(backpack_url('masjid/create'));
        }

        // Admin
        if (auth()->user()->hasRole('Admin')) {
            $totaltansaksi = Transaksi::whereStatus('paid')->whereMasjidId(auth()->user()->masjids->masjid->id)->take(3)->get();
            $totalCollection = Transaksi::whereStatus('paid')->whereMasjidId(auth()->user()->masjids->masjid->id)->sum('jumlah');
        }

        // Superadmin
        if (auth()->user()->hasRole('Superadmin')) {
            $totaltansaksi = null;
            $totalCollection = null;
        }

        return view('vendor.backpack.ui.dashboard', compact('totaltansaksi', 'totalCollection'));
    }

    public function exportTransaksi()
    {
        return Excel::download(new TransaksiExport, now() . '-transaksi-' . auth()->user()->masjids->masjid->name . '.xlsx');
    }
}
