<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNomorStsToObjekPajakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objek_pajak', function (Blueprint $table) {
            $table->string('nomor_sts',35)->nullable()->default(null)->after('nomor_skpd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objek_pajak', function (Blueprint $table) {
            $table->dropColumn('nomor_sts');
        });
    }
}
