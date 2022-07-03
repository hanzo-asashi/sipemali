<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnJenisBelanjaToBelanjaOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('belanja_opds', function (Blueprint $table) {
            $table->unsignedSmallInteger('jenis_belanja')->default(1)->change();
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
            //
        });
    }
}
