<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ZonaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('zona')->delete();

        DB::table('zona')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'kode' => '10',
                    'wilayah' => 'BNA ',
                ),
            1 =>
                array(
                    'id' => 9,
                    'kode' => '91',
                    'wilayah' => 'CITTA',
                ),
            2 =>
                array(
                    'id' => 5,
                    'kode' => '50',
                    'wilayah' => 'IKK - ABBANUANGE',
                ),
            3 =>
                array(
                    'id' => 4,
                    'kode' => '40',
                    'wilayah' => 'IKK - BATU-BATU',
                ),
            4 =>
                array(
                    'id' => 3,
                    'kode' => '30',
                    'wilayah' => 'IKK - CABENGE',
                ),
            5 =>
                array(
                    'id' => 6,
                    'kode' => '60',
                    'wilayah' => 'IKK - DONRI-DONRI',
                ),
            6 =>
                array(
                    'id' => 2,
                    'kode' => '20',
                    'wilayah' => 'IKK - TAKALALA',
                ),
            7 =>
                array(
                    'id' => 7,
                    'kode' => '70',
                    'wilayah' => 'IKK CITTA/TINCO',
                ),
            8 =>
                array(
                    'id' => 8,
                    'kode' => '80',
                    'wilayah' => 'PACONGKANG',
                ),
        ));


    }
}
