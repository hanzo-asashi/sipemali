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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('customer_id');
            $table->text('description')->nullable();
            $table->string('event')->nullable();
            $table->unsignedInteger('meter_awal')->default(0);
            $table->unsignedInteger('meter_akhir')->default(0);
            $table->unsignedInteger('pemakaian_air')->default(0);
            $table->unsignedDouble('dana_meter')->default(0);
            $table->unsignedDouble('biaya_layanan')->default(0);
            $table->unsignedDouble('total_tagihan')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_histories');
    }
};
