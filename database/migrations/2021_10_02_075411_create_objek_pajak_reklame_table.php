<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekPajakReklameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_pajak_reklame', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objek_pajak_id');
            $table->integer('id_kategori');
            $table->integer('id_jenis_usaha');
            $table->integer('id_jenis_reklame');
            $table->enum('izin', ['Ada', 'Tidak Ada']);
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('kuantiti');
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
        Schema::dropIfExists('objek_pajak_reklame');
    }
}
