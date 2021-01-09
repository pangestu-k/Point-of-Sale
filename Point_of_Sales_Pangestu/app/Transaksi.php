<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang;
use App\User;

class Transaksi extends Model
{
    protected $table = 'table_transaksi';
    protected $primaryKey = 'kd_transaksi';
    protected $fillable = ['total_barang', 'total_bayar', 'kembalian', 'total_harga', 'tanggal_beli'];


    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kd_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user');
    }
}
