<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Requests\DistributorRequest;
use App\ViewDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $distributors = Distributor::latest()->paginate(10);
        $distributors = Distributor::latest()->paginate(10);
        return view('pages.admin.distributors.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.distributors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistributorRequest $request)
    {
        $data = $request->all();
        $distributor = Distributor::create($data);

        if ($distributor) {
            //redirect dengan pesan sukses
            return redirect()->route('distributor.index')->with(['success' => 'Distributor Berhasil Disimpan!']);
        } else {
            return redirect()->route('distributor.index')->with(['toast_error' => 'Distributor Gagal Disimpan!']);
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
    public function edit(Distributor $distributor)
    {
        return view('pages.admin.distributors.edit', compact('distributor'));
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
            'alamat' => 'required'
        ]);
        $data = $request->all();
        $distributor = Distributor::findOrFail($id);
        $distributor->update($data);
        if ($distributor) {
            //redirect dengan pesan sukses
            return redirect()->route('distributor.index')->with(['success' => 'Distributor Berhasil Diedit!']);
        } else {
            return redirect()->route('distributor.index')->with(['toast_error' => 'Distributor Gagal Diedit!']);
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
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();
        if ($distributor) {
            return redirect()->route('distributor.index')->with(['success' => 'Distributor Berhasil Dihapus!']);
        } else {
            return redirect()->route('distributor.index')->with(['toast_error' => 'Distributor Gagal Dihapus!']);
        }
    }
}
