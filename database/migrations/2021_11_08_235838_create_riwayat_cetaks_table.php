<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatCetaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_cetaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id')->default(0);
            $table->unsignedTinyInteger('cetakan_ke')->default(1);
            $table->dateTime('tanggal_cetak')->default(now());
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
        Schema::dropIfExists('riwayat_cetaks');
    }
}
