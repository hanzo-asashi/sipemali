<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunggakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tunggakan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaran_id');
            $table->dateTime('tgl_bayar')->nullable();
            $table->dateTime('tgl_jatuh_tempo')->nullable();
            $table->unsignedInteger('lama_tunggakan')->nullable()->default(0);
            $table->unsignedDouble('jumlah_tagihan')->nullable()->default(0);
            $table->unsignedDouble('jumlah_bayar')->nullable()->default(0);
            $table->unsignedDouble('denda')->nullable()->default(0);
            $table->unsignedDouble('sisa_bayar')->nullable()->default(0);
            $table->tinyInteger('tagihan_ke')->nullable()->default(1);
            $table->tinyInteger('status_tunggakan')->default(0);
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
        Schema::dropIfExists('tunggakan');
    }
}
