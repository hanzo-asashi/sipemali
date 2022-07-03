<?php

namespace Database\Seeders;

use App\Models\JenisWajibPajak;
use Illuminate\Database\Seeder;

class JenisWajibPajakSeeder extends Seeder
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
            JenisWajibPajak::create([
                'nama_jenis_wp' => $value['name'],
            ]);
        }
    }

    public function data()
    {
        return [
            ['name' => 'Perorangan'],
            ['name' => 'Perusahaan'],
        ];
    }
}
