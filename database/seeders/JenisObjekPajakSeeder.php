<?php

namespace Database\Seeders;

use App\Models\JenisObjekPajak;
use Illuminate\Database\Seeder;

class JenisObjekPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->data();

        foreach ($data as $value) {
            JenisObjekPajak::create([
                'nama_jenis_op' => $value['value']['nama_jenis_op'],
                'no_rekening' => $value['value']['no_rekening'],
                'shortcode' => $value['value']['shortcode'],
            ]);
        }
    }

    public function data()
    {
        return [
            ['value' => ['nama_jenis_op' => 'Rumah Makan', 'no_rekening' => '','shortcode' => 'RMN']],
            ['value' => ['nama_jenis_op' => 'Hotel', 'no_rekening' => '','shortcode' => 'HTL']],
            ['value' => ['nama_jenis_op' => 'Reklame', 'no_rekening' => '','shortcode' => 'RKM']],
            ['value' => ['nama_jenis_op' => 'Tambang Mineral', 'no_rekening' => '','shortcode' => 'TBM']],
            ['value' => ['nama_jenis_op' => 'Penerangan Jalan Umum', 'no_rekening' => '','shortcode' => 'PJU']],
        ];
    }
}
