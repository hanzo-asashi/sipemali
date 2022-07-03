<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTotalTagihanToTunggakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tunggakan', function (Blueprint $table) {
            $table->unsignedDouble('total_tagihan')->nullable()->default(0)->after('denda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tunggakan', function (Blueprint $table) {
            //
        });
    }
}
