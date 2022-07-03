<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPajakPeneranganJalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pajak_penerangan_jalan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_objek_pajak');
            $table->enum('triwulan',['I','II','III','IV']);
            $table->year('tahun');
            $table->float('besaran_kwh');
            $table->double('nilai_pajak');
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
        Schema::dropIfExists('nilai_pajak_penerangan_jalan');
    }
}
