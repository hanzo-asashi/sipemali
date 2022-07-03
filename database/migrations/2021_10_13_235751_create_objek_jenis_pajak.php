<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekJenisPajak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_jenis_pajak', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('objek_pajak_id');
            $table->unsignedInteger('jenis_objek_pajak_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objek_jenis_pajak');
    }
}
