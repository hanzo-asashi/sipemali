<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            UserSeeder::class,
            AddressesTableSeeder::class,
            GolonganTarifTableSeeder::class,
            PelangganTableSeeder::class,
            StatusPembayaranSeeder::class,
            StatusSeeder::class,
            ZonaTableSeeder::class,
            MetodeBayarSeeder::class,
        ]);
    }
}
