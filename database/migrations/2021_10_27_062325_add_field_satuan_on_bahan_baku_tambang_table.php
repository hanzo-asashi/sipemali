<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSatuanOnBahanBakuTambangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan_baku_tambang', function (Blueprint $table) {
            $table->string('satuan',50)->nullable()->default('m3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan_baku_tambang', function (Blueprint $table) {
            $table->removeColumn('satuan');
        });
    }
}
