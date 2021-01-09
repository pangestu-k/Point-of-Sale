<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Merek;
use App\Distributor;
use App\Http\Requests\BarangRequest;
use App\ViewBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barangs = Barang::latest()->paginate(10);
        $barangs = Barang::latest()->paginate(10);
        $merekSelect = Merek::all();
        $distributorSelect = Distributor::all();
        $jumlahMerek = Merek::count('merek');
        $jumlahDistributor = Distributor::count('nama_distributor');
        return view('pages.admin.barangs.index', compact('barangs', 'merekSelect', 'distributorSelect', 'jumlahMerek', 'jumlahDistributor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merekSelect = Merek::all();
        $distributorSelect = Distributor::all();
        $jumlahMerek = Merek::count('merek');
        $jumlahDistributor = Distributor::count('nama_distributor');
        return view('pages.admin.barangs.create', compact('merekSelect', 'distributorSelect', 'jumlahMerek', 'jumlahDistributor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $data = $request->all();
        $barang = Barang::create($data);

        if ($barang) {
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Barang Berhasil Disimpan!']);
        } else {
            return redirect()->route('barang.index')->with(['toast_error' => 'Barang Gagal Disimpan!']);
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
    public function edit(Barang $barang)
    {
        $merekSelect = Merek::all();
        $distributorSelect = Distributor::all();
        return view('pages.admin.barangs.edit', compact('barang', 'merekSelect', 'distributorSelect'));
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
        $data = $request->all();
        $barang = Barang::findOrFail($id);
        $barang->update($data);
        if ($barang) {
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Barang Berhasil Diedit!']);
        } else {
            return redirect()->route('barang.index')->with(['toast_error' => 'Barang Gagal Diedit!']);
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
        $barang = Barang::findOrFail($id);
        $barang->delete();
        if ($barang) {
            return redirect()->route('barang.index')->with(['success' => 'Barang Berhasil Dihapus!']);
        } else {
            return redirect()->route('barang.index')->with(['toast_error' => 'Barang Gagal Dihapus!']);
        }
    }
}
