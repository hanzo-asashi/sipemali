<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPajakRumahMakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pajak_rumah_makan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_objek_pajak');
            $table->date('bulan_tahun_pajak');
            $table->double('nilai_pajak');
            $table->integer('metode_bayar');
            $table->unsignedInteger('persentase_nilai_pajak')->nullable()->default(0);
            $table->unsignedTinyInteger('status')->nullable()->default(0);
            $table->string('keterangan')->nullable()->default(null);
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
        Schema::dropIfExists('nilai_pajak_rumah_makan');
    }
}
