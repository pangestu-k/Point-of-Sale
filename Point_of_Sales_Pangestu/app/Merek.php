<?php

namespace App;

use App\Barang;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $table = 'table_merek';
    protected $primaryKey = 'kd_merek';
    protected $fillable = ['merek'];

    public function barang()
    {
        return $this->HasMany(Barang::class, 'kd_merek');
    }
}
