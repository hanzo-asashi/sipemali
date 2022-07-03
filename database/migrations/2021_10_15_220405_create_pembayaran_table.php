<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wajib_pajak_id');
            $table->unsignedBigInteger('objek_pajak_id');
            $table->string('no_transaksi',30)->nullable()->default('');
            $table->bigInteger('metode_bayar')->default(1);
            $table->string('nomor_sts',50)->nullable();
            $table->year('tahun')->nullable()->default(null);
            $table->string('bulan',4)->nullable()->default('01');
            $table->unsignedDouble('jumlah_bayar',30)->nullable()->default(0);
            $table->unsignedBigInteger('nilai_pajak')->nullable()->default(0);
            $table->unsignedBigInteger('denda')->nullable()->default(0);
            $table->string('sisa')->nullable()->default('0');
            $table->dateTime('jatuh_tempo')->nullable()->default(null);
            $table->unsignedTinyInteger('status_bayar')->default(0);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pembayaran');
    }
}
