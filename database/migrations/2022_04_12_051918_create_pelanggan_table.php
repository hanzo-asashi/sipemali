<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('no_sambungan', 30);
            $table->string('no_pelanggan', 10)->nullable();
            $table->string('nama_pelanggan', 150)->index('nama_pelanggan');
            $table->text('alamat_pelanggan')->nullable();
            $table->unsignedBigInteger('zona_id')->default(1)->index('zona');
            $table->unsignedBigInteger('golongan_id')->default(1)->index('golongan');
            $table->integer('bulan_langganan')->nullable();
            $table->year('tahun_langganan', 4)->nullable();
            $table->unsignedBigInteger('status_pelanggan')->default(1)->index('status_pelanggan');
            $table->unsignedTinyInteger('penagihan_pelanggan')->default(1);
            $table->unsignedTinyInteger('is_valid')->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->index(['alamat_pelanggan'], 'alamat_pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
