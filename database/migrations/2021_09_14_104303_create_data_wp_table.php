<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataWpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wajib_pajak', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jenis_wp');
            $table->string('nama_wp', 150);
            $table->string('nik_nib', 20);
            $table->string('nwpd', 20);
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('telepon', 20)->nullable()->default('-');
            $table->string('email')->nullable()->default(null);
            $table->text('alamat')->nullable()->default(null);
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
        Schema::dropIfExists('wajib_pajak');
    }
}
