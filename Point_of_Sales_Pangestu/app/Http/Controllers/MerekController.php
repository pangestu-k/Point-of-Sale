<?php

namespace App\Http\Controllers;

use App\Merek;
use App\Http\Requests\MerekRequest;
use App\ViewMerek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mereks = Merek::latest()->paginate(10);
        $mereks = Merek::latest()->paginate(10);
        return view('pages.admin.mereks.index', compact('mereks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.mereks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerekRequest $request)
    {
        $data = $request->all();
        $merek = Merek::create($data);

        if ($merek) {
            //redirect dengan pesan sukses
            return redirect()->route('merek.index')->with(['success' => 'Merk Berhasil Disimpan!']);
        } else {
            return redirect()->route('merek.index')->with(['toast_error' => 'Merk Gagal Disimpan!']);
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
    public function edit(Merek $merek)
    {
        return view('pages.admin.mereks.edit', compact('merek'));
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
        $merek = Merek::findOrFail($id);
        $merek->update($data);
        if ($merek) {
            //redirect dengan pesan sukses
            return redirect()->route('merek.index')->with(['success' => 'Merk Berhasil Diedit!']);
        } else {
            return redirect()->route('merek.index')->with(['toast_error' => 'Merk Gagal Diedit!']);
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
        $merek = Merek::findOrFail($id);
        $merek->delete();
        if ($merek) {
            return redirect()->route('merek.index')->with(['success' => 'Merk Berhasil Dihapus!']);
        } else {
            return redirect()->route('merek.index')->with(['toast_error' => 'Merk Gagal Dihapus!']);
        }
    }
}
