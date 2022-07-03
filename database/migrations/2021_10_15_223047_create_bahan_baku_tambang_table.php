<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanBakuTambangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_baku_tambang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_objek_pajak');
            $table->unsignedBigInteger('id_jenis_bahan_baku');
            $table->float('jumlah_volume');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_baku_tambangs');
    }
}
