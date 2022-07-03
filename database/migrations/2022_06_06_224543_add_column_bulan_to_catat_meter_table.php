<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catat_meter', function (Blueprint $table) {
            $table->unsignedInteger('bulan')->default(1)->after('user_id');
            $table->timestamp('periode')->nullable()->after('bulan')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catat_meter', function (Blueprint $table) {
            $table->dropColumn('bulan');
            $table->dropColumn('periode');
        });
    }
};
