<?php

namespace Database\Seeders;

use App\Models\JenisTarif;
use Illuminate\Database\Seeder;

class JenisTarifSeeder extends Seeder
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
            JenisTarif::create([
                'jenis' => $value['value']['jenis'],
                'nilai' => $value['value']['nilai'],
            ]);
        }
    }

    public function data()
    {
        return [
            ['value' => ['jenis' => 'Tarif Rokok', 'nilai' => '25%']],
            ['value' => ['jenis' => 'Tarif Non Rokok', 'nilai' => '20%']],
        ];
    }
}
