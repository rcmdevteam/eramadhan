<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class LotExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        dd('asdf');
    }
}