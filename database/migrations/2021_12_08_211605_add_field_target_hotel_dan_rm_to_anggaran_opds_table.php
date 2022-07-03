<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTargetHotelDanRmToAnggaranOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggaran_opds', function (Blueprint $table) {
            $table->unsignedDouble('target_pajak_rm')->nullable()->default(0);
            $table->unsignedDouble('target_pajak_htl')->nullable()->default(0);
            $table->unsignedDouble('realisasi_rm')->nullable()->default(0);
            $table->unsignedDouble('realisasi_htl')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn(['target_pajak_rm','target_pajak_htl','realisasi_rm','realisasi_htl']);
        });
    }
}
