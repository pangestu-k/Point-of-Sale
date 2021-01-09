<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Merek;
use App\Distributor;

class Barang extends Model
{
    protected $table = 'table_barang';
    protected $primaryKey = 'kd_barang';
    protected $fillable = ['nama_barang', 'kd_merek', 'kd_distributor', 'tanggal_masuk', 'harga_beli', 'harga_barang', 'stok_barang', 'keterangan'];

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'kd_merek');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'kd_distributor');
    }
}
