<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
            Status::create([
                'nama_status' => $value['nama_status'],
                'shortcode' => $value['shortcode'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'nama_status' => 'AKTIF',
                'shortcode' => 'AKT',
            ],
            [
                'nama_status' => 'DITANGGUHKAN',
                'shortcode' => 'TGH',
            ],
            [
                'nama_status' => 'DIDOP',
                'shortcode' => 'DOP',
            ],
        ];
    }
}
