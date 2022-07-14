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
            $table->id()->index();
            $table->string('no_transaksi', 30)->index();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('periode')->nullable();
            $table->unsignedTinyInteger('bulan_berjalan')->default(1);
            $table->year('tahun_berjalan', 4)->default('2022');
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->dateTime('tgl_bayar')->nullable();
            $table->unsignedInteger('stand_awal')->default(0);
            $table->unsignedInteger('stand_akhir')->default(0);
            $table->unsignedInteger('pemakaian_air_saat_ini')->default(0);
            $table->unsignedInteger('pemakaian_air_sebelumnya')->nullable();
            $table->double('harga_air')->unsigned()->default(0);
            $table->double('dana_meter')->unsigned()->default(0);
            $table->double('biaya_layanan')->unsigned()->default(0);
            $table->double('total_tagihan')->unsigned()->default(0);
            $table->double('total_bayar')->unsigned()->default(0);
            $table->double('denda')->unsigned()->default(0);
            $table->double('sisa')->unsigned()->default(0);
            $table->unsignedBigInteger('status_pembayaran')->default(1);
            $table->unsignedBigInteger('metode_bayar')->default(1);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('customer_id', 'pembayaran_customer_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('metode_bayar', 'pembayaran_metodebayar')->references('id')->on('metode_bayar')->onDelete('cascade');
            $table->foreign('status_pembayaran', 'pembayaran_status_pembayaran')->references('id')->on('status_pembayaran')->onDelete('cascade');
            $table->foreign('user_id', 'pembayaran_user_id')->references('id')->on('users')->onDelete('cascade');
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
