<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'table_distributor';
    protected $primaryKey = 'kd_distributor';
    protected $fillable = ['nama_distributor', 'alamat', 'no_telp'];
}
