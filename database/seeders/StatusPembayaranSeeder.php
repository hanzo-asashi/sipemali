<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPembayaranSeeder extends Seeder
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
            PaymentStatus::create([
                'name' => $value['nama_status'],
                'shortcode' => $value['shortcode'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'nama_status' => 'LUNAS',
                'shortcode' => 'LS',
            ],
            [
                'nama_status' => 'BELUM BAYAR',
                'shortcode' => 'BB',
            ],
            [
                'nama_status' => 'BAYAR SEBAGIAN',
                'shortcode' => 'BS',
            ],
        ];
    }
}
