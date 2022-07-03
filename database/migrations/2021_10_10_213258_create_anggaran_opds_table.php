<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggaranOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggaran_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained('daftar_opd');
            $table->string('nama_opd');
            $table->double('nilai_pagu');
            $table->double('target_pajak');
            $table->double('realisasi');
            $table->year('tahun');
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
        Schema::dropIfExists('anggaran_opds');
    }
}
