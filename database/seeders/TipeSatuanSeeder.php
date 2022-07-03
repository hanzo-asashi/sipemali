<?php

namespace Database\Seeders;

use App\Models\TipeSatuan;
use Illuminate\Database\Seeder;

class TipeSatuanSeeder extends Seeder
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
            TipeSatuan::create([
                'satuan' => $value['name'],
            ]);
        }
    }

    public function data()
    {
        return [
            ['name' => 'Unit'],
            ['name' => 'm2'],
            ['name' => 'Buah'],
            ['name' => 'Lembar'],
            ['name' => 'Jenis'],
        ];
    }
}
