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
        if (!auth()->user()->hasRole('Admin')) {
            return redirect(backpack_url('masjid/create'));
        }

        $totaltansaksi = Transaksi::whereStatus('paid')->whereMasjidId(auth()->user()->masjids->masjid->id)->take(3)->get();

        $totalCollection = Transaksi::whereStatus('paid')->whereMasjidId(auth()->user()->masjids->masjid->id)->sum('jumlah');

        return view('vendor.backpack.ui.dashboard', compact('totaltansaksi', 'totalCollection'));
    }

    public function exportTransaksi()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
}