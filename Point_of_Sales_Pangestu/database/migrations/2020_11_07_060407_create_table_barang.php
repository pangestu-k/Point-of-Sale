<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_barang', function (Blueprint $table) {
            $table->increments('kd_barang');
            $table->string('nama_barang');
            $table->integer('kd_merek')->unsigned();
            $table->integer('kd_distributor')->unsigned();
            $table->date('tanggal_masuk');
            $table->integer('harga_beli');
            $table->integer('harga_barang');
            $table->integer('stok_barang');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('kd_merek')
                ->references('kd_merek')
                ->on('table_merek')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('kd_distributor')
                ->references('kd_distributor')
                ->on('table_distributor')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_barang');
    }
}
