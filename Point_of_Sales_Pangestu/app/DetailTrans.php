<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTrans extends Model
{
    protected $table = 'table_detail_transaksi';
    protected $primaryKey = 'kd_detail_transaksi';
    protected $fillable = ['kd_transaksi', 'kd_barang', 'kd_user', 'qty', 'harga'];


    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kd_barang');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kd_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kd_user');
    }
}
