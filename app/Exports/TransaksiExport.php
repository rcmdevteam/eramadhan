<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    public function view(): View
    {
        return view('exports.transaksi', [
            'transaksi' => Transaksi::whereStatus('paid')->whereMasjidId(auth()->user()->masjids->masjid->id)->get()
        ]);
    }
}
