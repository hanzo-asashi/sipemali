<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBesaranKwhToObjekPajakPeneranganJalanUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objek_pajak_penerangan_jalan_umum', function (Blueprint $table) {
            $table->string('triwulan')->nullable()->default('pertama');
            $table->unsignedInteger('besaran_kwh')->default(0);
            $table->unsignedDouble('nilai_pajak')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objek_pajak_penerangan_jalan_umum', function (Blueprint $table) {
            $table->removeColumn('triwulan');
            $table->removeColumn('besaran_kwh');
            $table->removeColumn('nilai_pajak');
        });
    }
}
