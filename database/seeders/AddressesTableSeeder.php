<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('addresses')->delete();

        \DB::table('addresses')->insert([
            0 => [
                'id' => 1,
                'alamat' => 'JL.UJUNG',
            ],
            1 => [
                'id' => 2,
                'alamat' => 'JL.SALOTUNGO',
            ],
            2 => [
                'id' => 3,
                'alamat' => 'LOMPO',
            ],
            3 => [
                'id' => 4,
                'alamat' => 'JL.NURDIN SALEH',
            ],
            4 => [
                'id' => 5,
                'alamat' => 'JL.PENGAYOMAN',
            ],
            5 => [
                'id' => 6,
                'alamat' => 'JL.PASAR',
            ],
            6 => [
                'id' => 7,
                'alamat' => 'JL.KALINO',
            ],
            7 => [
                'id' => 8,
                'alamat' => 'JL.ATTANG BENTENG',
            ],
            8 => [
                'id' => 9,
                'alamat' => 'JL.PEMUDA',
            ],
            9 => [
                'id' => 10,
                'alamat' => 'JL.WIJAYA',
            ],
            10 => [
                'id' => 11,
                'alamat' => 'JL.KESATRIA',
            ],
            11 => [
                'id' => 12,
                'alamat' => 'JL.KAYANGAN',
            ],
            12 => [
                'id' => 13,
                'alamat' => 'JL.KEMAKMURAN',
            ],
            13 => [
                'id' => 14,
                'alamat' => 'JL.SAMUDRA',
            ],
            14 => [
                'id' => 15,
                'alamat' => 'SALOTUNGO',
            ],
            15 => [
                'id' => 16,
                'alamat' => 'JL.SAMUDRA/ASPOL',
            ],
            16 => [
                'id' => 17,
                'alamat' => 'JL.SUNU',
            ],
            17 => [
                'id' => 18,
                'alamat' => 'JL.SAMUDRA/JL.SANU',
            ],
            18 => [
                'id' => 19,
                'alamat' => 'ASPOL',
            ],
            19 => [
                'id' => 20,
                'alamat' => 'LAPPACABBU',
            ],
            20 => [
                'id' => 21,
                'alamat' => 'PERUMNAS',
            ],
            21 => [
                'id' => 22,
                'alamat' => 'B. LATEMMAMALA',
            ],
            22 => [
                'id' => 23,
                'alamat' => 'LOLLOE',
            ],
            23 => [
                'id' => 24,
                'alamat' => 'JL.NENEURANG',
            ],
            24 => [
                'id' => 25,
                'alamat' => 'JL.KEMAKMURAN/BTN',
            ],
            25 => [
                'id' => 26,
                'alamat' => 'CIKKE\'E',
            ],
            26 => [
                'id' => 27,
                'alamat' => 'BTN PEPABRI',
            ],
            27 => [
                'id' => 28,
                'alamat' => 'PAKKANREBETE',
            ],
            28 => [
                'id' => 29,
                'alamat' => 'JL.KEMAKMURAN PAKKANREBET',
            ],
            29 => [
                'id' => 30,
                'alamat' => 'JL.SUNU (JL.KEMAKMURAN)',
            ],
            30 => [
                'id' => 31,
                'alamat' => 'LIPPENNO',
            ],
            31 => [
                'id' => 32,
                'alamat' => 'JL.KESATRIA/KAYANGAN',
            ],
            32 => [
                'id' => 33,
                'alamat' => 'JL.KAYANGAN/NENEURANG',
            ],
            33 => [
                'id' => 34,
                'alamat' => 'BILA SELATAN',
            ],
            34 => [
                'id' => 35,
                'alamat' => 'BTN KAYANGAN',
            ],
            35 => [
                'id' => 36,
                'alamat' => 'LAPPACABBU KAYANGAN',
            ],
            36 => [
                'id' => 37,
                'alamat' => 'LAPPASABBU',
            ],
            37 => [
                'id' => 38,
                'alamat' => 'JL.KAYANGAN / PAKKAREBETE',
            ],
            38 => [
                'id' => 39,
                'alamat' => 'JL KAYANGAN LAPPA CABBU',
            ],
            39 => [
                'id' => 40,
                'alamat' => 'JL. NENE URANG',
            ],
            40 => [
                'id' => 41,
                'alamat' => 'BTN',
            ],
            41 => [
                'id' => 42,
                'alamat' => 'BTN SOPPENG PERMAI',
            ],
            42 => [
                'id' => 43,
                'alamat' => 'BTN HUSADA PERMAI',
            ],
            43 => [
                'id' => 44,
                'alamat' => 'BNT LALABATA INDAH',
            ],
            44 => [
                'id' => 45,
                'alamat' => 'JL.KEMAKMURAN BTN HSP',
            ],
            45 => [
                'id' => 46,
                'alamat' => 'BPD PERMAI',
            ],
            46 => [
                'id' => 47,
                'alamat' => 'BTN HUSADA BAKTI',
            ],
            47 => [
                'id' => 48,
                'alamat' => 'BTN HUSADA',
            ],
            48 => [
                'id' => 49,
                'alamat' => 'BTN LALABATA INDAH',
            ],
            49 => [
                'id' => 50,
                'alamat' => 'PERUMNAS ANGREK PERMAI',
            ],
            50 => [
                'id' => 51,
                'alamat' => 'BTN PERUMNAS',
            ],
            51 => [
                'id' => 52,
                'alamat' => 'BKT LATEMMAMALA',
            ],
            52 => [
                'id' => 53,
                'alamat' => 'JL.MERDEKA',
            ],
            53 => [
                'id' => 54,
                'alamat' => 'JL.PANRE LANTO',
            ],
            54 => [
                'id' => 55,
                'alamat' => 'LORONG DELAPAN',
            ],
            55 => [
                'id' => 56,
                'alamat' => 'JL.MESS TINGGI',
            ],
            56 => [
                'id' => 57,
                'alamat' => 'JL. BALUBU',
            ],
            57 => [
                'id' => 58,
                'alamat' => 'COPPO BUKKANG',
            ],
            58 => [
                'id' => 59,
                'alamat' => 'JL.BILA UTARA',
            ],
            59 => [
                'id' => 60,
                'alamat' => 'JL.MANGKAWANI',
            ],
            60 => [
                'id' => 61,
                'alamat' => 'JL A. ABD MUIS',
            ],
            61 => [
                'id' => 62,
                'alamat' => 'BILA SELATAN BUCCELLO',
            ],
            62 => [
                'id' => 63,
                'alamat' => 'BILA SELATAN / A.ABD.MUIS',
            ],
            63 => [
                'id' => 64,
                'alamat' => 'BIL-SEL/MANGKAWANI',
            ],
            64 => [
                'id' => 65,
                'alamat' => 'BILA UTARA/SELEPPE\'E',
            ],
            65 => [
                'id' => 66,
                'alamat' => 'BAKTI/BILA UTARA',
            ],
            66 => [
                'id' => 67,
                'alamat' => 'JL.BILA UTARA / SEWO',
            ],
            67 => [
                'id' => 68,
                'alamat' => 'BILA UTARA/JERA\'E',
            ],
            68 => [
                'id' => 69,
                'alamat' => 'MANGKAWANI',
            ],
            69 => [
                'id' => 70,
                'alamat' => 'JERA\'E',
            ],
            70 => [
                'id' => 71,
                'alamat' => 'JL.JERA\'E',
            ],
            71 => [
                'id' => 72,
                'alamat' => 'SEWO',
            ],
            72 => [
                'id' => 73,
                'alamat' => 'JL.NENEURANG SEWO',
            ],
            73 => [
                'id' => 74,
                'alamat' => 'JL.MANGKAWANI SEWO',
            ],
            74 => [
                'id' => 75,
                'alamat' => 'JL.MERDEKA JERA\'E',
            ],
            75 => [
                'id' => 76,
                'alamat' => 'COPPO BUKKANG BILUT',
            ],
            76 => [
                'id' => 77,
                'alamat' => 'SALEPPE/SEWO',
            ],
            77 => [
                'id' => 78,
                'alamat' => 'MADINING',
            ],
            78 => [
                'id' => 79,
                'alamat' => 'TANETE',
            ],
            79 => [
                'id' => 80,
                'alamat' => 'LAPAJUNG BARAT',
            ],
            80 => [
                'id' => 81,
                'alamat' => 'JL.PESANTREN',
            ],
            81 => [
                'id' => 82,
                'alamat' => 'JL.PESANTREN LPJ.BARAT',
            ],
            82 => [
                'id' => 83,
                'alamat' => 'JL.PASAR SENTRAL',
            ],
            83 => [
                'id' => 84,
                'alamat' => 'JL.MALAKA',
            ],
            84 => [
                'id' => 85,
                'alamat' => 'MALAKA / LAPPA\'E',
            ],
            85 => [
                'id' => 86,
                'alamat' => 'SENTRAL / BATU MASSILA',
            ],
            86 => [
                'id' => 87,
                'alamat' => 'LAPAJUNG LABURAWUNG',
            ],
            87 => [
                'id' => 88,
                'alamat' => 'LABURAWUNG',
            ],
            88 => [
                'id' => 89,
                'alamat' => 'JL.SENTRAL',
            ],
            89 => [
                'id' => 90,
                'alamat' => 'JL.MALAKA RAYA',
            ],
            90 => [
                'id' => 91,
                'alamat' => 'BTN MALAKA',
            ],
            91 => [
                'id' => 92,
                'alamat' => 'TANETE/LABURAWUNG',
            ],
            92 => [
                'id' => 93,
                'alamat' => 'MALAKA',
            ],
            93 => [
                'id' => 94,
                'alamat' => 'LAKACERE LABURAWUNG',
            ],
            94 => [
                'id' => 95,
                'alamat' => 'BTN LABURAWUNG',
            ],
            95 => [
                'id' => 96,
                'alamat' => 'LEPPANGENG / TANETE',
            ],
            96 => [
                'id' => 97,
                'alamat' => 'JL. PISANG',
            ],
            97 => [
                'id' => 98,
                'alamat' => 'TANETE MALAKA',
            ],
            98 => [
                'id' => 99,
                'alamat' => 'LAPPA\'E MALAKA',
            ],
            99 => [
                'id' => 100,
                'alamat' => 'LEPPANGENG MALAKA',
            ],
            100 => [
                'id' => 101,
                'alamat' => 'PERUMNAS LANGKEME',
            ],
            101 => [
                'id' => 102,
                'alamat' => 'BTN MALAKA SARI',
            ],
            102 => [
                'id' => 103,
                'alamat' => 'LAPAJUNG',
            ],
            103 => [
                'id' => 104,
                'alamat' => 'JL.RAYA MALAKA',
            ],
            104 => [
                'id' => 105,
                'alamat' => 'LAPPAE',
            ],
            105 => [
                'id' => 106,
                'alamat' => 'BTN MALAKA RAYA',
            ],
            106 => [
                'id' => 107,
                'alamat' => 'KOMP.LANGKEMME',
            ],
            107 => [
                'id' => 108,
                'alamat' => 'BTN MALAKA INDAH',
            ],
            108 => [
                'id' => 109,
                'alamat' => 'MALAKA / BTN MALAKA',
            ],
            109 => [
                'id' => 110,
                'alamat' => 'R.DINAS LANGKEMME MALAKA',
            ],
            110 => [
                'id' => 111,
                'alamat' => 'WATU-WATU',
            ],
            111 => [
                'id' => 112,
                'alamat' => 'KOMP.MALAKA INDAH',
            ],
            112 => [
                'id' => 113,
                'alamat' => 'KOMP.MALAKA',
            ],
            113 => [
                'id' => 114,
                'alamat' => 'LP.MALAKA',
            ],
            114 => [
                'id' => 115,
                'alamat' => 'LEPPANGENG',
            ],
            115 => [
                'id' => 116,
                'alamat' => 'JL.MALAKA INDAH',
            ],
            116 => [
                'id' => 117,
                'alamat' => 'MALAKA INDAH',
            ],
            117 => [
                'id' => 118,
                'alamat' => 'MALAKA POROS BAKA\'E',
            ],
            118 => [
                'id' => 119,
                'alamat' => 'MALAKA / VILLA',
            ],
            119 => [
                'id' => 120,
                'alamat' => 'JL.LAMAPPOLEWARE',
            ],
            120 => [
                'id' => 121,
                'alamat' => 'BTN GRIYA MALAKA',
            ],
            121 => [
                'id' => 122,
                'alamat' => 'V.LAMAPOLOWARE',
            ],
            122 => [
                'id' => 123,
                'alamat' => 'BTN GBMI',
            ],
            123 => [
                'id' => 124,
                'alamat' => 'MALAKA KOMP. LKM',
            ],
            124 => [
                'id' => 125,
                'alamat' => 'MADELLO/LAKACERE',
            ],
            125 => [
                'id' => 126,
                'alamat' => 'SENTRAL',
            ],
            126 => [
                'id' => 127,
                'alamat' => 'MADELLO',
            ],
            127 => [
                'id' => 128,
                'alamat' => 'LAKACERE',
            ],
            128 => [
                'id' => 129,
                'alamat' => 'MADELLO/OMPO',
            ],
            129 => [
                'id' => 130,
                'alamat' => 'OMPO',
            ],
            130 => [
                'id' => 131,
                'alamat' => 'JL.H.A.WANA',
            ],
            131 => [
                'id' => 132,
                'alamat' => 'MADELLO/LAWO',
            ],
            132 => [
                'id' => 133,
                'alamat' => 'LAWO',
            ],
            133 => [
                'id' => 134,
                'alamat' => 'HAWA',
            ],
            134 => [
                'id' => 135,
                'alamat' => 'LAWO/JL.PESANTREN',
            ],
            135 => [
                'id' => 136,
                'alamat' => 'LAWO / LESU',
            ],
            136 => [
                'id' => 137,
                'alamat' => 'BTN PAYUNG MAS',
            ],
            137 => [
                'id' => 138,
                'alamat' => 'L A W O',
            ],
            138 => [
                'id' => 139,
                'alamat' => 'BATU-BATU',
            ],
            139 => [
                'id' => 140,
                'alamat' => 'LIMPOMAJANG',
            ],
            140 => [
                'id' => 141,
                'alamat' => 'BAKA\'E',
            ],
            141 => [
                'id' => 142,
                'alamat' => 'MACCOPE',
            ],
            142 => [
                'id' => 143,
                'alamat' => 'GTP SALOTUNGO',
            ],
            143 => [
                'id' => 144,
                'alamat' => 'BAKA\'E /SALOTUNGO',
            ],
            144 => [
                'id' => 145,
                'alamat' => 'SALOTUNGO / LOLLO\'E',
            ],
            145 => [
                'id' => 146,
                'alamat' => 'MACCOPE / LOLLO\'E',
            ],
            146 => [
                'id' => 147,
                'alamat' => 'CIKKE\'E SALOTUNGO',
            ],
            147 => [
                'id' => 148,
                'alamat' => 'BAKA\'E LOLLOE',
            ],
            148 => [
                'id' => 149,
                'alamat' => 'BTN GTP',
            ],
            149 => [
                'id' => 150,
                'alamat' => 'UKKE\'E',
            ],
            150 => [
                'id' => 151,
                'alamat' => 'BENTENGE',
            ],
            151 => [
                'id' => 152,
                'alamat' => 'BENTENGE/UKKEE',
            ],
            152 => [
                'id' => 153,
                'alamat' => 'SOLIE',
            ],
            153 => [
                'id' => 154,
                'alamat' => 'TONRONGE',
            ],
            154 => [
                'id' => 155,
                'alamat' => 'TAKALALA',
            ],
            155 => [
                'id' => 156,
                'alamat' => 'TAKALALA/SENTRAL',
            ],
            156 => [
                'id' => 157,
                'alamat' => 'JL.A.POTTO',
            ],
            157 => [
                'id' => 158,
                'alamat' => 'JL. MACANRE',
            ],
            158 => [
                'id' => 159,
                'alamat' => 'JL.A.PALOMPOI',
            ],
            159 => [
                'id' => 160,
                'alamat' => 'JL.A.PANNE',
            ],
            160 => [
                'id' => 161,
                'alamat' => 'JL.PASAR LAMA',
            ],
            161 => [
                'id' => 162,
                'alamat' => 'JL.MESJID RAYA',
            ],
            162 => [
                'id' => 163,
                'alamat' => 'JL.ALLIMBANGENG',
            ],
            163 => [
                'id' => 164,
                'alamat' => 'JL.AL-MUHAJIRIN',
            ],
            164 => [
                'id' => 165,
                'alamat' => 'JL.SUKARELA',
            ],
            165 => [
                'id' => 166,
                'alamat' => 'JL.SUNGAI WALANAE',
            ],
            166 => [
                'id' => 167,
                'alamat' => 'JL. LOMPENGENG',
            ],
            167 => [
                'id' => 168,
                'alamat' => 'JL.PAHLAWAN',
            ],
            168 => [
                'id' => 169,
                'alamat' => 'JL.GOTONG ROYONG',
            ],
            169 => [
                'id' => 170,
                'alamat' => 'JL.PEMILIHAN',
            ],
            170 => [
                'id' => 171,
                'alamat' => 'JL.AMAN',
            ],
            171 => [
                'id' => 172,
                'alamat' => 'JL.CABENGE',
            ],
            172 => [
                'id' => 173,
                'alamat' => 'JL.ALLAPORENG',
            ],
            173 => [
                'id' => 174,
                'alamat' => 'S.WALENNA\'E',
            ],
            174 => [
                'id' => 175,
                'alamat' => 'JL.POTTO',
            ],
            175 => [
                'id' => 176,
                'alamat' => 'MACANRE',
            ],
            176 => [
                'id' => 177,
                'alamat' => 'JL.H.A.PANNE',
            ],
            177 => [
                'id' => 178,
                'alamat' => 'LOMPENGENG',
            ],
            178 => [
                'id' => 179,
                'alamat' => 'CABENGE',
            ],
            179 => [
                'id' => 180,
                'alamat' => 'ABBANUANGE',
            ],
            180 => [
                'id' => 181,
                'alamat' => 'TETEWATU',
            ],
            181 => [
                'id' => 182,
                'alamat' => 'PALERO',
            ],
            182 => [
                'id' => 183,
                'alamat' => 'TAJUNCU',
            ],
            183 => [
                'id' => 184,
                'alamat' => 'BTN BUCCELLO',
            ],
            184 => [
                'id' => 185,
                'alamat' => 'PEPPAE, ABBANUANGE',
            ],
            185 => [
                'id' => 186,
                'alamat' => 'MANGKUTTU',
            ],
            186 => [
                'id' => 187,
                'alamat' => 'BTN BUKIT MATRA',
            ],
            187 => [
                'id' => 188,
                'alamat' => 'SALENG, ABBANUANGE',
            ],
            188 => [
                'id' => 189,
                'alamat' => 'TOGORA',
            ],
            189 => [
                'id' => 190,
                'alamat' => 'BERRU/ABBANUANGE',
            ],
            190 => [
                'id' => 191,
                'alamat' => 'DESA LABAE',
            ],
            191 => [
                'id' => 192,
                'alamat' => 'RAFILLA RESIDENCE / CIKKE',
            ],
            192 => [
                'id' => 193,
                'alamat' => 'TONRONGE, TETEWATU',
            ],
            193 => [
                'id' => 194,
                'alamat' => 'BTN KOLAM MAS INDAH',
            ],
            194 => [
                'id' => 195,
                'alamat' => 'BTN MASAGO LOLLOE',
            ],
            195 => [
                'id' => 196,
                'alamat' => 'KALAKKANG',
            ],
            196 => [
                'id' => 197,
                'alamat' => 'BTN TOMPO TOBANI',
            ],
            197 => [
                'id' => 198,
                'alamat' => 'BTN LALABATA PERMAI',
            ],
            198 => [
                'id' => 199,
                'alamat' => 'BTN SINAR MATRA',
            ],
            199 => [
                'id' => 200,
                'alamat' => 'BTN HANDAYANI LOLLOE',
            ],
            200 => [
                'id' => 304,
                'alamat' => 'SEDUTA PERMAI MALAKA',
            ],
            201 => [
                'id' => 401,
                'alamat' => 'BTN CAHAYA',
            ],
            202 => [
                'id' => 501,
                'alamat' => 'TINCO',
            ],
            203 => [
                'id' => 502,
                'alamat' => 'TETEWATU',
            ],
            204 => [
                'id' => 606,
                'alamat' => 'TAJUNCU',
            ],
            205 => [
                'id' => 607,
                'alamat' => 'PALANGISENG',
            ],
            206 => [
                'id' => 608,
                'alamat' => 'TAKAMMUTA',
            ],
            207 => [
                'id' => 609,
                'alamat' => 'LAPPA WATU WATU',
            ],
            208 => [
                'id' => 610,
                'alamat' => 'BTN GRAHA MERDEKA',
            ],
            209 => [
                'id' => 611,
                'alamat' => 'PANINCONG',
            ],
            210 => [
                'id' => 612,
                'alamat' => 'MARIO INDAH',
            ],
            211 => [
                'id' => 613,
                'alamat' => 'BTN BUKIT MALAKA',
            ],
            212 => [
                'id' => 614,
                'alamat' => 'GRAHA LAKACERE',
            ],
            213 => [
                'id' => 615,
                'alamat' => 'BTN POROS LEMPA',
            ],
            214 => [
                'id' => 616,
                'alamat' => 'TUJUH WALI WALI',
            ],
            215 => [
                'id' => 617,
                'alamat' => 'LALABATA PERMAI',
            ],
            216 => [
                'id' => 618,
                'alamat' => 'BUCCELLO',
            ],
            217 => [
                'id' => 619,
                'alamat' => 'PARENRING',
            ],
            218 => [
                'id' => 620,
                'alamat' => 'TETEWATU / TONRONGE',
            ],
            219 => [
                'id' => 621,
                'alamat' => 'PALERO / PALANGISENG',
            ],
            220 => [
                'id' => 622,
                'alamat' => 'TEGORA / PALANGISENG',
            ],
            221 => [
                'id' => 623,
                'alamat' => 'JL.NENE URANG',
            ],
            222 => [
                'id' => 624,
                'alamat' => 'BUKIT KAYANGAN',
            ],
            223 => [
                'id' => 625,
                'alamat' => 'JL.A.MAKKULAWU',
            ],
            224 => [
                'id' => 626,
                'alamat' => 'JL.BATU MASSILA',
            ],
            225 => [
                'id' => 627,
                'alamat' => 'BTN PAKANREBETE',
            ],
            226 => [
                'id' => 628,
                'alamat' => 'PAROTO',
            ],
            227 => [
                'id' => 629,
                'alamat' => 'PALERO / ABBANUANGE',
            ],
            228 => [
                'id' => 630,
                'alamat' => 'JL.A.MADE ALI',
            ],
            229 => [
                'id' => 631,
                'alamat' => 'TANETE',
            ],
            230 => [
                'id' => 632,
                'alamat' => 'TANJONGE',
            ],
            231 => [
                'id' => 633,
                'alamat' => 'LASUDU',
            ],
            232 => [
                'id' => 634,
                'alamat' => 'ALLANGKARAKENGE',
            ],
            233 => [
                'id' => 635,
                'alamat' => 'JEKKA\'E',
            ],
            234 => [
                'id' => 636,
                'alamat' => 'SAREBATUE',
            ],
            235 => [
                'id' => 637,
                'alamat' => 'PISING',
            ],
            236 => [
                'id' => 638,
                'alamat' => 'AMESANGENG',
            ],
            237 => [
                'id' => 639,
                'alamat' => 'ANAWANGENG',
            ],
            238 => [
                'id' => 640,
                'alamat' => 'ATTALIANG',
            ],
            239 => [
                'id' => 641,
                'alamat' => 'TOCAMPU',
            ],
            240 => [
                'id' => 642,
                'alamat' => 'BTN BUMI RIO BATARA',
            ],
            241 => [
                'id' => 643,
                'alamat' => 'JL.PETTA WANUA',
            ],
            242 => [
                'id' => 644,
                'alamat' => 'BTN BAITI JANNATI',
            ],
            243 => [
                'id' => 645,
                'alamat' => 'PERINTIS',
            ],
            244 => [
                'id' => 646,
                'alamat' => 'VILLA MAKNUNAK',
            ],
            245 => [
                'id' => 647,
                'alamat' => 'VILLA SANUBARI',
            ],
            246 => [
                'id' => 648,
                'alamat' => 'BTN BUMI RIO BATARA',
            ],
            247 => [
                'id' => 649,
                'alamat' => 'SEPPANG',
            ],
            248 => [
                'id' => 650,
                'alamat' => 'LR.TEMMAPAFI',
            ],
            249 => [
                'id' => 651,
                'alamat' => 'SEPPANG',
            ],
            250 => [
                'id' => 652,
                'alamat' => 'GRIYA CITRA LAPAJUNG',
            ],
            251 => [
                'id' => 653,
                'alamat' => 'SEDUTA RESIDEN MALAKA',
            ],
            252 => [
                'id' => 654,
                'alamat' => 'JL.LAMAPPOLOWARE',
            ],
            253 => [
                'id' => 655,
                'alamat' => 'ASMIL MALAKA',
            ],
            254 => [
                'id' => 656,
                'alamat' => 'PESONA ALAM OMPO',
            ],
            255 => [
                'id' => 657,
                'alamat' => 'GRIYA ALJIBATUN',
            ],
            256 => [
                'id' => 658,
                'alamat' => 'VILLA RESIDENCE',
            ],
            257 => [
                'id' => 659,
                'alamat' => 'LAKIBONG',
            ],
            258 => [
                'id' => 660,
                'alamat' => 'MALAKA/LAPPAE',
            ],
            259 => [
                'id' => 661,
                'alamat' => 'BTN LEMPA',
            ],
            260 => [
                'id' => 662,
                'alamat' => 'BTN LEMPA',
            ],
            261 => [
                'id' => 663,
                'alamat' => 'BTN ROYAL HARMONI',
            ],
            262 => [
                'id' => 664,
                'alamat' => 'GAMALAKA RESIDENCE',
            ],
            263 => [
                'id' => 665,
                'alamat' => 'CITTA',
            ],
            264 => [
                'id' => 666,
                'alamat' => 'SEDUTA LAND LAPPAE',
            ],
            265 => [
                'id' => 667,
                'alamat' => 'PAKANREBETE/GAPIS',
            ],
        ]);
    }
}
