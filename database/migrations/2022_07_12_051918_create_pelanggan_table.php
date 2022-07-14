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
    public function up(): void
    {
        Schema::create('pelanggan', static function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('no_sambungan', 30)->index('no_sambungan');
            $table->string('no_pelanggan', 10)->nullable();
            $table->string('nama_pelanggan', 150)->index('nama_pelanggan');
            $table->text('alamat_pelanggan')->nullable()->index('alamat_pelanggan');
            $table->foreignId('zona_id')->constrained('zona')->index('zona_id');
            $table->foreignId('golongan_id')->constrained('golongan_tarif')->index('golongan_id');
//            $table->unsignedBigInteger('zona_id')->default(1)->index('zona');
//            $table->unsignedBigInteger('golongan_id')->default(1)->index('golongan');
            $table->integer('bulan_langganan')->nullable();
            $table->year('tahun_langganan', 4)->nullable();
            $table->foreignId('status_pelanggan')->constrained('statuses')->index('status_pelanggan');
//            $table->unsignedBigInteger('status_pelanggan')->default(1)->index('status_pelanggan');
            $table->unsignedTinyInteger('penagihan_pelanggan')->default(1);
            $table->unsignedTinyInteger('is_valid')->default(0)->index('is_valid');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
