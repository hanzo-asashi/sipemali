<?php

namespace Database\Seeders;

use App\Models\MetodeBayar;
use App\Models\MetodeBayarPajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodeBayarSeeder extends Seeder
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
            MetodeBayar::create([
                'nama' => $value['nama_status'],
                'kode' => $value['shortcode'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'nama_status' => 'LOKET PEMBAYARAN',
                'shortcode' => 'LKT',
            ],
            [
                'nama_status' => 'TRANSFER BANK',
                'shortcode' => 'TRF',
            ],
            [
                'nama_status' => 'ONLINE',
                'shortcode' => 'ONL',
            ],
        ];
    }
}
