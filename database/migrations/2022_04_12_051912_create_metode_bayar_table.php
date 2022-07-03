<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodeBayarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metode_bayar', function (Blueprint $table) {
            $table->id()->index();
            $table->string('kode', 5)->nullable();
            $table->string('nama', 50)->default('');
            $table->string('no_rekening', 15)->nullable();
            $table->string('deskripsi', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metode_bayar');
    }
}
