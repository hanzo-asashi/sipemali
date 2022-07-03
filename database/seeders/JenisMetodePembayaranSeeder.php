<?php

namespace Database\Seeders;

use App\Models\MetodeBayarPajak;
use Illuminate\Database\Seeder;

class JenisMetodePembayaranSeeder extends Seeder
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
            MetodeBayarPajak::create([
                'jenis_metode' => $value['name'],
            ]);
        }
    }

    public function data()
    {
        return [
            ['name' => 'Setoran Bank'],
            ['name' => 'Cash Ke Petugas Daerah'],
        ];
    }
}
