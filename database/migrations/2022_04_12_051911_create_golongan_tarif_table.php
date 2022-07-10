<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGolonganTarifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golongan_tarif', function (Blueprint $table) {
            $table->id();
            $table->string('kode_golongan', 20)->unique();
            $table->string('nama_golongan', 100)->nullable()->index('nama_golongan');
            $table->string('deskripsi', 100)->nullable();
            $table->unsignedTinyInteger('blok_1')->default(1);
            $table->unsignedTinyInteger('blok_2')->default(1);
            $table->unsignedTinyInteger('blok_3')->default(1);
            $table->unsignedTinyInteger('blok_4')->default(1);
            $table->double('tarif_blok_1')->unsigned()->default(0);
            $table->double('tarif_blok_2')->unsigned()->default(0);
            $table->double('tarif_blok_3')->unsigned()->default(0);
            $table->double('tarif_blok_4')->unsigned()->default(0);
            $table->double('biaya_administrasi')->unsigned()->default(0);
            $table->double('dana_meter')->unsigned()->default(0);
            $table->double('tarif_pasang_baru')->unsigned()->default(0);
            $table->unsignedTinyInteger('tgl_bayar_akhir')->default(1);
            $table->double('denda_bln_1')->unsigned()->default(0);
            $table->double('denda_bln_2')->unsigned()->default(0);
            $table->double('denda_lebih_2_bln')->unsigned()->default(0);
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
        Schema::dropIfExists('golongan_tarif');
    }
}
