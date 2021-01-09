<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Barang;
use App\DetailTrans;
use App\Exports\BarangExport;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\TransaksiExport;
use App\ViewBarang;
use App\ViewTransaksi;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        // $barangs = Barang::latest()->paginate(10);
        $barangs = Barang::latest()->paginate(10);
        // $transaksis = Transaksi::latest()->paginate(10);
        $transaksis = Transaksi::where('total_bayar', '!=', '0')->orderBy('tanggal_beli', 'ASC')->paginate(10);
        return view('pages.manager.laporans.index', compact('barangs', 'transaksis'));
    }

    public function show($id)
    {
        $totalHargaBarang = DetailTrans::where('kd_transaksi', '=', $id)->sum('harga');
        $jumlahQty = DetailTrans::where('kd_transaksi', '=', $id)->sum('qty');
        $barangBeli = DetailTrans::where('kd_transaksi', '=', $id)->get();
        $hargaHargaan = Transaksi::where('kd_transaksi', '=', $id)->first();

        // dd($hargaHargaan);

        $barangSelect = Barang::all();
        $userSelect = User::all();
        $stok =  Barang::sum('stok_barang');

        return view('pages.manager.laporans.show', compact('barangSelect', 'userSelect', 'stok', 'totalHargaBarang', 'jumlahQty', 'barangBeli', 'hargaHargaan'));
    }

    public function bala(Request $request)
    {
        $barangs = Barang::whereBetween(DB::raw('DATE(created_at)'), array($request->get('dari'), $request->get('sampai')))->get();
        return view('pages.manager.laporans.laporanBarang', compact('barangs'));
    }

    public function tala(Request $request)
    {
        $transaksis = Transaksi::whereBetween(DB::raw('DATE(created_at)'), array($request->get('dari'), $request->get('sampai')))->get();
        return view('pages.manager.laporans.laporanTransaksi', compact('transaksis'));
    }

    public function export_excel()
    {
        return (new TransaksiExport)->download('Transaksi.xlsx');
    }

    public function export_excelBarang()
    {
        return (new BarangExport)->download('Barang.xlsx');
    }
}
