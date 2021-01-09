<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::prefix('adm')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::resource('distributor', DistributorController::class);

        Route::resource('barang', BarangController::class);

        Route::resource('merek', MerekController::class);
    });

Route::prefix('ksr')
    ->middleware(['auth', 'kasir'])
    ->group(function () {

        Route::resource('transaksi', TransaksiController::class);
        Route::delete('transaksiHapus/{id}', "TransaksiController@destroyKasir")->name('transaksi.destroyKasir');

        Route::get('editSntr/{transaksi}', "TransaksiController@editSntr")->name('editSntr');
        Route::put('editSntr/{id}', "TransaksiController@updateSntr")->name('updateSntr');
    });

Route::prefix('mngr')
    ->middleware(['auth', 'manager'])
    ->group(function () {

        Route::resource('laporan', LaporanController::class);
        Route::get('exportExcelTransaksi', "LaporanController@export_excel")->name('excelTransaks');
        Route::get('exportExcelBarang', "LaporanController@export_excelBarang")->name('excelBarangs');
        Route::get('bala', "LaporanController@bala")->name('bala');
        Route::get('tala', "LaporanController@tala")->name('tala');
    });
