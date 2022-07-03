<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunBulanToBelanjaOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('belanja_opds', function (Blueprint $table) {
            $table->string('bulan',3)->nullable()->default(null);
            $table->year('tahun')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('belanja_opds', function (Blueprint $table) {
            $table->removeColumn('bulan');
            $table->removeColumn('tahun');
        });
    }
}
