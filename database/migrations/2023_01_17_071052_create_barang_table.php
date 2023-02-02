<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('code');
            $table->dateTime('tgl_masuk');
            $table->string('kepemilikan');
            $table->string('foto');
            $table->text('keterangan');
            $table->bigInteger('id_lokasi');
            $table->bigInteger('id_kategori');
            $table->bigInteger('id_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
