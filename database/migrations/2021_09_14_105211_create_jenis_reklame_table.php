<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisReklameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_reklame', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis_op');
            $table->integer('periode_pembayaran');
            $table->unsignedDouble('nilai_strategis');
            $table->unsignedDouble('nilai_jual_objek_pajak');
            $table->integer('tipe_satuan');
            $table->integer('jenis_tarif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_reklame');
    }
}
