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
        Schema::create('catat_meter', function (Blueprint $table) {
            $table->id()->index('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('angka_meter_lama');
            $table->unsignedInteger('angka_meter_baru');
            $table->unsignedTinyInteger('status_meter');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('customer_id', 'catat_meter_customer_id')->references('id')->on('pelanggan');
            $table->foreign('user_id', 'catat_meter_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catat_meter');
    }
};
