<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_detail_transaksi', function (Blueprint $table) {
            $table->increments('kd_detail_transaksi');
            $table->integer('kd_transaksi')->unsigned();
            $table->integer('kd_barang')->unsigned();
            $table->integer('kd_user')->unsigned();
            $table->integer('qty');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('kd_barang')
                ->references('kd_barang')
                ->on('table_barang')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('kd_user')
                ->references('kd_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('kd_transaksi')
                ->references('kd_transaksi')
                ->on('table_transaksi')
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
        //
    }
}
