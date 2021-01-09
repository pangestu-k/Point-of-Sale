<?php

namespace App\Exports;

use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $transaksis = Transaksi::where('total_bayar', '!=', '0')->get();

        return view('pages.manager.laporans.excel.transaksi', [
            'transaksis' => $transaksis
        ]);
    }
}
