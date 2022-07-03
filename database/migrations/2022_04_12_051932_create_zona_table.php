<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona', function (Blueprint $table) {
            $table->id()->index();
            $table->string('kode', 30)->default('10')->index('kode')->unique();
            $table->string('wilayah', 60)->index('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zona');
    }
}
