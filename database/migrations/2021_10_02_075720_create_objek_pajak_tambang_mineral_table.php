<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekPajakTambangMineralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_pajak_tambang_mineral', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objek_pajak_id');
            $table->dateTime('tanggal_setoran');
            $table->string('nama_wajib_pajak');
            $table->string('jenis_pekerjaan');
            $table->integer('opd_penanggungjawab_anggaran');
            $table->string('no_kontrak');
            $table->year('tahun_berdasarkan_kontrak');
            $table->double('nilai_kontrak');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->string('keterangan');
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
        Schema::dropIfExists('objek_pajak_tambang_mineral');
    }
}
