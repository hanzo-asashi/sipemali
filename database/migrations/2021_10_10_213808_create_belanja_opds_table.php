<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelanjaOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belanja_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained('daftar_opd');
            $table->foreignId('objek_pajak_id')->constrained('objek_pajak');
            $table->enum('jenis_belanja',['Hotel','Rumah Makan']);
            $table->double('jumlah_transaksi');
            $table->date('periode');
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
        Schema::dropIfExists('belanja_opds');
    }
}
