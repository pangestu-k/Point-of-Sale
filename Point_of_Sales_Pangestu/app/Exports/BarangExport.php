<?php

namespace App\Exports;

use App\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class BarangExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $barangs = Barang::all();

        return view('pages.manager.laporans.excel.barang', [
            'barangs' => $barangs
        ]);
    }
}
