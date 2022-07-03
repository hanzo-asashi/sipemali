<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPajakHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pajak_hotel', function (Blueprint $table) {
            $table->id();
            $table->integer('id_objek_pajak');
            $table->date('bulan_tahun_pajak');
            $table->double('nilai_pajak');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->string('keterangan');
            $table->integer('metode_bayar');
            $table->string('persentase_nilai_pajak');
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
        Schema::dropIfExists('nilai_pajak_hotel');
    }
}
