<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Barang;
use App\DetailTrans;
use App\User;
use Illuminate\Support\Carbon;
use App\Http\Requests\TransaksiRequest;
use App\ViewKasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Transaksi::where('total_bayar', '=', '0')->get('kd_transaksi');

        if ($check->isEmpty()) {
            Transaksi::create([
                'total_bayar' => 0,
                'total_harga' => 0,
                'total_barang' => 0,
                'kembalian' => 0,
                // 'tanggal_beli' => Carbon::now()
            ]);
        }

        $kasirs = Transaksi::where('total_harga', '!=', 0)->get();
        $idTransaksi = Transaksi::orderBy('kd_transaksi', 'DESC')->first();
        $transaksis = DetailTrans::where('kd_transaksi', '=', $idTransaksi->kd_transaksi)->paginate(10);
        $transaksib = Transaksi::where('total_bayar', '>', '0')->get();

        $totalHargaBarang = DetailTrans::where('kd_transaksi', '=', $idTransaksi->kd_transaksi)->sum('harga');


        $barangSelect = DB::table('table_barang')
            ->where('stok_barang', '>', 0)
            ->get();
        $userSelect = User::all();
        $stok =  Barang::sum('stok_barang');
        return view('pages.kasir.transaksis.index', compact('transaksis', 'transaksib', 'barangSelect', 'userSelect', 'stok', 'idTransaksi', 'totalHargaBarang', 'kasirs'));
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check = Transaksi::orderBy('kd_transaksi', 'DESC')->first();
        $barangSelect = DB::table('table_barang')
            ->where('stok_barang', '>', 0)
            ->get();
        $userSelect = User::all();
        $stok =  Barang::sum('stok_barang');
        return view('pages.kasir.transaksis.create', compact('barangSelect', 'userSelect', 'stok', 'check'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $barangData = Barang::where('kd_barang', $request->kd_barang)->first();
        $data['harga'] = $request->qty * $barangData->harga_barang;

        // $data['total_bayar'] = 0;
        // $data['kembalian'] = 0;

        if ($request->qty > $barangData->stok_barang) {
            return redirect()->route('transaksi.index')->with([
                'stok_kurang' => 'Stok Kurang',
                'toast_error' => 'Stok Kurang'
            ]);
        } else {
            $DetailTransaksi = DetailTrans::create($data);

            if ($DetailTransaksi) {
                //Mengurangi Stok
                $barangData->stok_barang = $barangData->stok_barang - $data['qty'];
                $barangData->save();
                return redirect()->route('transaksi.index')->with(['success' => 'Barang Masuk keranjang!']);
            } else {
                return redirect()->route('transaksi.index')->with(['toast_error' => 'Yah Keranjangnya bolong!']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $totalHargaBarang = DetailTrans::where('kd_transaksi', '=', $transaksi->kd_transaksi)->sum('harga');
        $jumlahQty = DetailTrans::where('kd_transaksi', '=', $transaksi->kd_transaksi)->sum('qty');
        $barangBeli = DetailTrans::where('kd_transaksi', '=', $transaksi->kd_transaksi)->get();
        // dd($barangBeli); 
        $barangSelect = Barang::all();
        $userSelect = User::all();
        $stok =  Barang::sum('stok_barang');
        return view('pages.kasir.transaksis.edit', compact('transaksi', 'barangSelect', 'userSelect', 'stok', 'totalHargaBarang', 'jumlahQty', 'barangBeli'));
    }

    public function editSntr(DetailTrans $transaksi)
    {
        // dd($transaksi);
        $barangSelect = DB::table('table_barang')
            ->where('stok_barang', '>', 0)
            ->get();
        $stok =  Barang::sum('stok_barang');
        return view('pages.kasir.transaksis.editSntr', compact('transaksi', 'barangSelect', 'stok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'total_bayar' => 'required'
        ]);
        $data = $request->all();
        $transaksi = Transaksi::findOrFail($id);
        $data['kembalian'] = $request->total_bayar - $data['total_harga'];
        $data['tanggal_beli'] = Carbon::now('y d t');

        // dd($data['tanggal_beli']);

        if ($request->total_bayar < $data['total_harga']) {
            return redirect()->back()->with(
                [
                    'uang_kurang' => 'Uang Kurang',
                    'toast_error' => 'Uang Kurang'
                ]
            );
        } else {
            $transaksi->update($data);

            if ($transaksi) {
                return redirect()->route('transaksi.index')->with([
                    'success' => 'Barang Berhasil Dibeli!',
                    'berhasil' => 'Barang Berhasil Dibeli!',
                ]);
            } else {
                return redirect()->route('transaksi.index')->with(['toast_error' => 'Barang Gagal Dibeli!']);
            }
        }
    }

    public function updateSntr(Request $request, $id)
    {
        $data = $request->all();
        $transaksi = DetailTrans::findOrFail($id);
        $barangData = Barang::where('kd_barang', $request->kd_barang)->first();
        $data['harga'] = $request->qty * $barangData->harga_barang;
        $data['total_bayar'] = 0;
        $data['kembalian'] = 0;

        if ($request->qty > $barangData->stok_barang) {
            return redirect()->back()->with([
                'stok_kurang' => 'Stok Kurang',
                'toast_error' => 'Stok Kurang'
            ]);
        } else {
            $transaksi->update($data);

            if ($transaksi) {
                //redirect dengan pesan sukses
                return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
            } else {
                return redirect()->route('transaksi.index')->with(['toast_error' => 'Data Gagal Disimpan!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = DetailTrans::findOrFail($id);
        $transaksi->delete();

        if ($transaksi) {
            return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('transaksi.index')->with(['toast_error' => 'Data Gagal Dihapus!']);
        }
    }

    public function destroyKasir($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        if ($transaksi) {
            return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('transaksi.index')->with(['toast_error' => 'Data Gagal Dihapus!']);
        }
    }
}
