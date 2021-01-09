<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Barang, Merek, Transaksi, User};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $level = Auth::user()->level;
        $transaksi = Transaksi::count();
        $barang = Barang::count();
        $user = User::count();
        $merek = Merek::count();

        return view('home', compact('level', 'transaksi', 'barang', 'user', 'merek'));
    }
}
