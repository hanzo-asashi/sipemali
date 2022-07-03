<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(1);
            $table->integer('wajib_pajak_id')->default(0);
            $table->string('username', 40)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('nop_pbb', 30)->nullable();
            $table->year('tahun_sppt')->default(now()->year);
            $table->integer('status_hubungan')->nullable();
            $table->integer('domisili')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
