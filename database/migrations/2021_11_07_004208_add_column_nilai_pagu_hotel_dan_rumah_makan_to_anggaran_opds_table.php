<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNilaiPaguHotelDanRumahMakanToAnggaranOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggaran_opds', function (Blueprint $table) {
            $table->unsignedDouble('nilai_pagu_rm')->nullable()->default(0);
            $table->unsignedDouble('nilai_pagu_htl')->nullable()->default(0);
            $table->unsignedTinyInteger('jenis_anggaran')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggaran_opds', function (Blueprint $table) {
            $table->dropColumn('nilai_pagu_htl','nilai_pagu_rm','jenis_anggaran');
        });
    }
}
