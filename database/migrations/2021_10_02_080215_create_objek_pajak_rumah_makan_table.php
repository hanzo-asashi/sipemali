<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekPajakRumahMakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_pajak_rumah_makan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objek_pajak_id');
            $table->enum('izin', ['Ada', 'Tidak Ada']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objek_pajak_rumah_makan');
    }
}
