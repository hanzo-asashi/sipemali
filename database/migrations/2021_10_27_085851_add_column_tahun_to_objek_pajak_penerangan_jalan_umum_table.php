<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTahunToObjekPajakPeneranganJalanUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objek_pajak_penerangan_jalan_umum', function (Blueprint $table) {
            $table->year('tahun_pajak_ppj')->nullable()->default(now()->year);
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
            $table->dropColumn('tahun_pajak_ppj');
        });
    }
}
