<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GolonganTarifTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('golongan_tarif')->delete();

        \DB::table('golongan_tarif')->insert([
            0 => [
                'id' => 1,
                'kode_golongan' => '111',
                'nama_golongan' => 'SU',
                'deskripsi' => 'Sosial Umum',
                'blok_1' => 40,
                'blok_2' => 40,
                'blok_3' => 40,
                'blok_4' => 1,
                'tarif_blok_1' => 1550.0,
                'tarif_blok_2' => 1550.0,
                'tarif_blok_3' => 1550.0,
                'tarif_blok_4' => 1550.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1020000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id' => 2,
                'kode_golongan' => '121',
                'nama_golongan' => 'SK',
                'deskripsi' => 'Sosial Khusus',
                'blok_1' => 10,
                'blok_2' => 20,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 1750.0,
                'tarif_blok_2' => 2100.0,
                'tarif_blok_3' => 2450.0,
                'tarif_blok_4' => 3100.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1020000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id' => 3,
                'kode_golongan' => '211',
                'nama_golongan' => 'RT-A',
                'deskripsi' => 'Rumah Tangga A',
                'blok_1' => 10,
                'blok_2' => 20,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 2300.0,
                'tarif_blok_2' => 2600.0,
                'tarif_blok_3' => 3000.0,
                'tarif_blok_4' => 3500.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1055000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id' => 4,
                'kode_golongan' => '221',
                'nama_golongan' => 'RT-B',
                'deskripsi' => 'Rumah Tangga B',
                'blok_1' => 10,
                'blok_2' => 20,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 2750.0,
                'tarif_blok_2' => 3100.0,
                'tarif_blok_3' => 3650.0,
                'tarif_blok_4' => 4100.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1090000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            4 => [
                'id' => 5,
                'kode_golongan' => '231',
                'nama_golongan' => 'IP-A',
                'deskripsi' => 'Instansi Pemerintah A',
                'blok_1' => 10,
                'blok_2' => 20,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 3000.0,
                'tarif_blok_2' => 3750.0,
                'tarif_blok_3' => 5300.0,
                'tarif_blok_4' => 6500.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1260000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            5 => [
                'id' => 6,
                'kode_golongan' => '232',
                'nama_golongan' => 'IP-B',
                'deskripsi' => 'Instansi Pemerintah B',
                'blok_1' => 10,
                'blok_2' => 20,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 3000.0,
                'tarif_blok_2' => 3750.0,
                'tarif_blok_3' => 5300.0,
                'tarif_blok_4' => 6500.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1260000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            6 => [
                'id' => 7,
                'kode_golongan' => '311',
                'nama_golongan' => 'NK',
                'deskripsi' => 'Niaga Kecil',
                'blok_1' => 20,
                'blok_2' => 30,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 4800.0,
                'tarif_blok_2' => 5100.0,
                'tarif_blok_3' => 5100.0,
                'tarif_blok_4' => 5750.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1320000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            7 => [
                'id' => 8,
                'kode_golongan' => '321',
                'nama_golongan' => 'NB-A',
                'deskripsi' => 'Niaga Besar A',
                'blok_1' => 20,
                'blok_2' => 30,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 5350.0,
                'tarif_blok_2' => 5750.0,
                'tarif_blok_3' => 5750.0,
                'tarif_blok_4' => 6550.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1390000.0,
                'tgl_bayar_akhir' => 23,
                'denda_bln_1' => 5000.0,
                'denda_bln_2' => 5000.0,
                'denda_lebih_2_bln' => 5000.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            8 => [
                'id' => 9,
                'kode_golongan' => '322',
                'nama_golongan' => 'NB-B',
                'deskripsi' => 'Niaga Besar B',
                'blok_1' => 20,
                'blok_2' => 30,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 5350.0,
                'tarif_blok_2' => 5750.0,
                'tarif_blok_3' => 5750.0,
                'tarif_blok_4' => 6550.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 1390000.0,
                'tgl_bayar_akhir' => 31,
                'denda_bln_1' => 0.0,
                'denda_bln_2' => 0.0,
                'denda_lebih_2_bln' => 0.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            9 => [
                'id' => 10,
                'kode_golongan' => '411',
                'nama_golongan' => 'IK',
                'deskripsi' => 'Industri Kecil',
                'blok_1' => 20,
                'blok_2' => 30,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 5800.0,
                'tarif_blok_2' => 6100.0,
                'tarif_blok_3' => 6100.0,
                'tarif_blok_4' => 7100.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 0.0,
                'tgl_bayar_akhir' => 31,
                'denda_bln_1' => 0.0,
                'denda_bln_2' => 0.0,
                'denda_lebih_2_bln' => 0.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            10 => [
                'id' => 11,
                'kode_golongan' => '421',
                'nama_golongan' => 'IB',
                'deskripsi' => 'Industri Besar',
                'blok_1' => 20,
                'blok_2' => 30,
                'blok_3' => 30,
                'blok_4' => 1,
                'tarif_blok_1' => 6350.0,
                'tarif_blok_2' => 6950.0,
                'tarif_blok_3' => 6950.0,
                'tarif_blok_4' => 8150.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 0.0,
                'tgl_bayar_akhir' => 31,
                'denda_bln_1' => 0.0,
                'denda_bln_2' => 0.0,
                'denda_lebih_2_bln' => 0.0,
                'created_at' => null,
                'updated_at' => null,
            ],
            11 => [
                'id' => 12,
                'kode_golongan' => '511',
                'nama_golongan' => 'K',
                'deskripsi' => 'Khusus',
                'blok_1' => 1,
                'blok_2' => 1,
                'blok_3' => 1,
                'blok_4' => 1,
                'tarif_blok_1' => 0.0,
                'tarif_blok_2' => 0.0,
                'tarif_blok_3' => 0.0,
                'tarif_blok_4' => 0.0,
                'biaya_administrasi' => 2000.0,
                'dana_meter' => 2500.0,
                'tarif_pasang_baru' => 0.0,
                'tgl_bayar_akhir' => 31,
                'denda_bln_1' => 0.0,
                'denda_bln_2' => 0.0,
                'denda_lebih_2_bln' => 0.0,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
