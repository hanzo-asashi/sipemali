<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPajakTambangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pajak_tambang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_objek_pajak');
            $table->integer('id_bahan_baku');
            $table->double('jumlah_tagihan');
            $table->double('jumlah_penerimaan');
            $table->integer('metode_bayar');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_pajak_tambang');
    }
}
