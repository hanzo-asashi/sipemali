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
        
        \DB::table('addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'alamat' => 'JL.UJUNG',
            ),
            1 => 
            array (
                'id' => 2,
                'alamat' => 'JL.SALOTUNGO',
            ),
            2 => 
            array (
                'id' => 3,
                'alamat' => 'LOMPO',
            ),
            3 => 
            array (
                'id' => 4,
                'alamat' => 'JL.NURDIN SALEH',
            ),
            4 => 
            array (
                'id' => 5,
                'alamat' => 'JL.PENGAYOMAN',
            ),
            5 => 
            array (
                'id' => 6,
                'alamat' => 'JL.PASAR',
            ),
            6 => 
            array (
                'id' => 7,
                'alamat' => 'JL.KALINO',
            ),
            7 => 
            array (
                'id' => 8,
                'alamat' => 'JL.ATTANG BENTENG',
            ),
            8 => 
            array (
                'id' => 9,
                'alamat' => 'JL.PEMUDA',
            ),
            9 => 
            array (
                'id' => 10,
                'alamat' => 'JL.WIJAYA',
            ),
            10 => 
            array (
                'id' => 11,
                'alamat' => 'JL.KESATRIA',
            ),
            11 => 
            array (
                'id' => 12,
                'alamat' => 'JL.KAYANGAN',
            ),
            12 => 
            array (
                'id' => 13,
                'alamat' => 'JL.KEMAKMURAN',
            ),
            13 => 
            array (
                'id' => 14,
                'alamat' => 'JL.SAMUDRA',
            ),
            14 => 
            array (
                'id' => 15,
                'alamat' => 'SALOTUNGO',
            ),
            15 => 
            array (
                'id' => 16,
                'alamat' => 'JL.SAMUDRA/ASPOL',
            ),
            16 => 
            array (
                'id' => 17,
                'alamat' => 'JL.SUNU',
            ),
            17 => 
            array (
                'id' => 18,
                'alamat' => 'JL.SAMUDRA/JL.SANU',
            ),
            18 => 
            array (
                'id' => 19,
                'alamat' => 'ASPOL',
            ),
            19 => 
            array (
                'id' => 20,
                'alamat' => 'LAPPACABBU',
            ),
            20 => 
            array (
                'id' => 21,
                'alamat' => 'PERUMNAS',
            ),
            21 => 
            array (
                'id' => 22,
                'alamat' => 'B. LATEMMAMALA',
            ),
            22 => 
            array (
                'id' => 23,
                'alamat' => 'LOLLOE',
            ),
            23 => 
            array (
                'id' => 24,
                'alamat' => 'JL.NENEURANG',
            ),
            24 => 
            array (
                'id' => 25,
                'alamat' => 'JL.KEMAKMURAN/BTN',
            ),
            25 => 
            array (
                'id' => 26,
                'alamat' => 'CIKKE\'E',
            ),
            26 => 
            array (
                'id' => 27,
                'alamat' => 'BTN PEPABRI',
            ),
            27 => 
            array (
                'id' => 28,
                'alamat' => 'PAKKANREBETE',
            ),
            28 => 
            array (
                'id' => 29,
                'alamat' => 'JL.KEMAKMURAN PAKKANREBET',
            ),
            29 => 
            array (
                'id' => 30,
            'alamat' => 'JL.SUNU (JL.KEMAKMURAN)',
            ),
            30 => 
            array (
                'id' => 31,
                'alamat' => 'LIPPENNO',
            ),
            31 => 
            array (
                'id' => 32,
                'alamat' => 'JL.KESATRIA/KAYANGAN',
            ),
            32 => 
            array (
                'id' => 33,
                'alamat' => 'JL.KAYANGAN/NENEURANG',
            ),
            33 => 
            array (
                'id' => 34,
                'alamat' => 'BILA SELATAN',
            ),
            34 => 
            array (
                'id' => 35,
                'alamat' => 'BTN KAYANGAN',
            ),
            35 => 
            array (
                'id' => 36,
                'alamat' => 'LAPPACABBU KAYANGAN',
            ),
            36 => 
            array (
                'id' => 37,
                'alamat' => 'LAPPASABBU',
            ),
            37 => 
            array (
                'id' => 38,
                'alamat' => 'JL.KAYANGAN / PAKKAREBETE',
            ),
            38 => 
            array (
                'id' => 39,
                'alamat' => 'JL KAYANGAN LAPPA CABBU',
            ),
            39 => 
            array (
                'id' => 40,
                'alamat' => 'JL. NENE URANG',
            ),
            40 => 
            array (
                'id' => 41,
                'alamat' => 'BTN',
            ),
            41 => 
            array (
                'id' => 42,
                'alamat' => 'BTN SOPPENG PERMAI',
            ),
            42 => 
            array (
                'id' => 43,
                'alamat' => 'BTN HUSADA PERMAI',
            ),
            43 => 
            array (
                'id' => 44,
                'alamat' => 'BNT LALABATA INDAH',
            ),
            44 => 
            array (
                'id' => 45,
                'alamat' => 'JL.KEMAKMURAN BTN HSP',
            ),
            45 => 
            array (
                'id' => 46,
                'alamat' => 'BPD PERMAI',
            ),
            46 => 
            array (
                'id' => 47,
                'alamat' => 'BTN HUSADA BAKTI',
            ),
            47 => 
            array (
                'id' => 48,
                'alamat' => 'BTN HUSADA',
            ),
            48 => 
            array (
                'id' => 49,
                'alamat' => 'BTN LALABATA INDAH',
            ),
            49 => 
            array (
                'id' => 50,
                'alamat' => 'PERUMNAS ANGREK PERMAI',
            ),
            50 => 
            array (
                'id' => 51,
                'alamat' => 'BTN PERUMNAS',
            ),
            51 => 
            array (
                'id' => 52,
                'alamat' => 'BKT LATEMMAMALA',
            ),
            52 => 
            array (
                'id' => 53,
                'alamat' => 'JL.MERDEKA',
            ),
            53 => 
            array (
                'id' => 54,
                'alamat' => 'JL.PANRE LANTO',
            ),
            54 => 
            array (
                'id' => 55,
                'alamat' => 'LORONG DELAPAN',
            ),
            55 => 
            array (
                'id' => 56,
                'alamat' => 'JL.MESS TINGGI',
            ),
            56 => 
            array (
                'id' => 57,
                'alamat' => 'JL. BALUBU',
            ),
            57 => 
            array (
                'id' => 58,
                'alamat' => 'COPPO BUKKANG',
            ),
            58 => 
            array (
                'id' => 59,
                'alamat' => 'JL.BILA UTARA',
            ),
            59 => 
            array (
                'id' => 60,
                'alamat' => 'JL.MANGKAWANI',
            ),
            60 => 
            array (
                'id' => 61,
                'alamat' => 'JL A. ABD MUIS',
            ),
            61 => 
            array (
                'id' => 62,
                'alamat' => 'BILA SELATAN BUCCELLO',
            ),
            62 => 
            array (
                'id' => 63,
                'alamat' => 'BILA SELATAN / A.ABD.MUIS',
            ),
            63 => 
            array (
                'id' => 64,
                'alamat' => 'BIL-SEL/MANGKAWANI',
            ),
            64 => 
            array (
                'id' => 65,
                'alamat' => 'BILA UTARA/SELEPPE\'E',
            ),
            65 => 
            array (
                'id' => 66,
                'alamat' => 'BAKTI/BILA UTARA',
            ),
            66 => 
            array (
                'id' => 67,
                'alamat' => 'JL.BILA UTARA / SEWO',
            ),
            67 => 
            array (
                'id' => 68,
                'alamat' => 'BILA UTARA/JERA\'E',
            ),
            68 => 
            array (
                'id' => 69,
                'alamat' => 'MANGKAWANI',
            ),
            69 => 
            array (
                'id' => 70,
                'alamat' => 'JERA\'E',
            ),
            70 => 
            array (
                'id' => 71,
                'alamat' => 'JL.JERA\'E',
            ),
            71 => 
            array (
                'id' => 72,
                'alamat' => 'SEWO',
            ),
            72 => 
            array (
                'id' => 73,
                'alamat' => 'JL.NENEURANG SEWO',
            ),
            73 => 
            array (
                'id' => 74,
                'alamat' => 'JL.MANGKAWANI SEWO',
            ),
            74 => 
            array (
                'id' => 75,
                'alamat' => 'JL.MERDEKA JERA\'E',
            ),
            75 => 
            array (
                'id' => 76,
                'alamat' => 'COPPO BUKKANG BILUT',
            ),
            76 => 
            array (
                'id' => 77,
                'alamat' => 'SALEPPE/SEWO',
            ),
            77 => 
            array (
                'id' => 78,
                'alamat' => 'MADINING',
            ),
            78 => 
            array (
                'id' => 79,
                'alamat' => 'TANETE',
            ),
            79 => 
            array (
                'id' => 80,
                'alamat' => 'LAPAJUNG BARAT',
            ),
            80 => 
            array (
                'id' => 81,
                'alamat' => 'JL.PESANTREN',
            ),
            81 => 
            array (
                'id' => 82,
                'alamat' => 'JL.PESANTREN LPJ.BARAT',
            ),
            82 => 
            array (
                'id' => 83,
                'alamat' => 'JL.PASAR SENTRAL',
            ),
            83 => 
            array (
                'id' => 84,
                'alamat' => 'JL.MALAKA',
            ),
            84 => 
            array (
                'id' => 85,
                'alamat' => 'MALAKA / LAPPA\'E',
            ),
            85 => 
            array (
                'id' => 86,
                'alamat' => 'SENTRAL / BATU MASSILA',
            ),
            86 => 
            array (
                'id' => 87,
                'alamat' => 'LAPAJUNG LABURAWUNG',
            ),
            87 => 
            array (
                'id' => 88,
                'alamat' => 'LABURAWUNG',
            ),
            88 => 
            array (
                'id' => 89,
                'alamat' => 'JL.SENTRAL',
            ),
            89 => 
            array (
                'id' => 90,
                'alamat' => 'JL.MALAKA RAYA',
            ),
            90 => 
            array (
                'id' => 91,
                'alamat' => 'BTN MALAKA',
            ),
            91 => 
            array (
                'id' => 92,
                'alamat' => 'TANETE/LABURAWUNG',
            ),
            92 => 
            array (
                'id' => 93,
                'alamat' => 'MALAKA',
            ),
            93 => 
            array (
                'id' => 94,
                'alamat' => 'LAKACERE LABURAWUNG',
            ),
            94 => 
            array (
                'id' => 95,
                'alamat' => 'BTN LABURAWUNG',
            ),
            95 => 
            array (
                'id' => 96,
                'alamat' => 'LEPPANGENG / TANETE',
            ),
            96 => 
            array (
                'id' => 97,
                'alamat' => 'JL. PISANG',
            ),
            97 => 
            array (
                'id' => 98,
                'alamat' => 'TANETE MALAKA',
            ),
            98 => 
            array (
                'id' => 99,
                'alamat' => 'LAPPA\'E MALAKA',
            ),
            99 => 
            array (
                'id' => 100,
                'alamat' => 'LEPPANGENG MALAKA',
            ),
            100 => 
            array (
                'id' => 101,
                'alamat' => 'PERUMNAS LANGKEME',
            ),
            101 => 
            array (
                'id' => 102,
                'alamat' => 'BTN MALAKA SARI',
            ),
            102 => 
            array (
                'id' => 103,
                'alamat' => 'LAPAJUNG',
            ),
            103 => 
            array (
                'id' => 104,
                'alamat' => 'JL.RAYA MALAKA',
            ),
            104 => 
            array (
                'id' => 105,
                'alamat' => 'LAPPAE',
            ),
            105 => 
            array (
                'id' => 106,
                'alamat' => 'BTN MALAKA RAYA',
            ),
            106 => 
            array (
                'id' => 107,
                'alamat' => 'KOMP.LANGKEMME',
            ),
            107 => 
            array (
                'id' => 108,
                'alamat' => 'BTN MALAKA INDAH',
            ),
            108 => 
            array (
                'id' => 109,
                'alamat' => 'MALAKA / BTN MALAKA',
            ),
            109 => 
            array (
                'id' => 110,
                'alamat' => 'R.DINAS LANGKEMME MALAKA',
            ),
            110 => 
            array (
                'id' => 111,
                'alamat' => 'WATU-WATU',
            ),
            111 => 
            array (
                'id' => 112,
                'alamat' => 'KOMP.MALAKA INDAH',
            ),
            112 => 
            array (
                'id' => 113,
                'alamat' => 'KOMP.MALAKA',
            ),
            113 => 
            array (
                'id' => 114,
                'alamat' => 'LP.MALAKA',
            ),
            114 => 
            array (
                'id' => 115,
                'alamat' => 'LEPPANGENG',
            ),
            115 => 
            array (
                'id' => 116,
                'alamat' => 'JL.MALAKA INDAH',
            ),
            116 => 
            array (
                'id' => 117,
                'alamat' => 'MALAKA INDAH',
            ),
            117 => 
            array (
                'id' => 118,
                'alamat' => 'MALAKA POROS BAKA\'E',
            ),
            118 => 
            array (
                'id' => 119,
                'alamat' => 'MALAKA / VILLA',
            ),
            119 => 
            array (
                'id' => 120,
                'alamat' => 'JL.LAMAPPOLEWARE',
            ),
            120 => 
            array (
                'id' => 121,
                'alamat' => 'BTN GRIYA MALAKA',
            ),
            121 => 
            array (
                'id' => 122,
                'alamat' => 'V.LAMAPOLOWARE',
            ),
            122 => 
            array (
                'id' => 123,
                'alamat' => 'BTN GBMI',
            ),
            123 => 
            array (
                'id' => 124,
                'alamat' => 'MALAKA KOMP. LKM',
            ),
            124 => 
            array (
                'id' => 125,
                'alamat' => 'MADELLO/LAKACERE',
            ),
            125 => 
            array (
                'id' => 126,
                'alamat' => 'SENTRAL',
            ),
            126 => 
            array (
                'id' => 127,
                'alamat' => 'MADELLO',
            ),
            127 => 
            array (
                'id' => 128,
                'alamat' => 'LAKACERE',
            ),
            128 => 
            array (
                'id' => 129,
                'alamat' => 'MADELLO/OMPO',
            ),
            129 => 
            array (
                'id' => 130,
                'alamat' => 'OMPO',
            ),
            130 => 
            array (
                'id' => 131,
                'alamat' => 'JL.H.A.WANA',
            ),
            131 => 
            array (
                'id' => 132,
                'alamat' => 'MADELLO/LAWO',
            ),
            132 => 
            array (
                'id' => 133,
                'alamat' => 'LAWO',
            ),
            133 => 
            array (
                'id' => 134,
                'alamat' => 'HAWA',
            ),
            134 => 
            array (
                'id' => 135,
                'alamat' => 'LAWO/JL.PESANTREN',
            ),
            135 => 
            array (
                'id' => 136,
                'alamat' => 'LAWO / LESU',
            ),
            136 => 
            array (
                'id' => 137,
                'alamat' => 'BTN PAYUNG MAS',
            ),
            137 => 
            array (
                'id' => 138,
                'alamat' => 'L A W O',
            ),
            138 => 
            array (
                'id' => 139,
                'alamat' => 'BATU-BATU',
            ),
            139 => 
            array (
                'id' => 140,
                'alamat' => 'LIMPOMAJANG',
            ),
            140 => 
            array (
                'id' => 141,
                'alamat' => 'BAKA\'E',
            ),
            141 => 
            array (
                'id' => 142,
                'alamat' => 'MACCOPE',
            ),
            142 => 
            array (
                'id' => 143,
                'alamat' => 'GTP SALOTUNGO',
            ),
            143 => 
            array (
                'id' => 144,
                'alamat' => 'BAKA\'E /SALOTUNGO',
            ),
            144 => 
            array (
                'id' => 145,
                'alamat' => 'SALOTUNGO / LOLLO\'E',
            ),
            145 => 
            array (
                'id' => 146,
                'alamat' => 'MACCOPE / LOLLO\'E',
            ),
            146 => 
            array (
                'id' => 147,
                'alamat' => 'CIKKE\'E SALOTUNGO',
            ),
            147 => 
            array (
                'id' => 148,
                'alamat' => 'BAKA\'E LOLLOE',
            ),
            148 => 
            array (
                'id' => 149,
                'alamat' => 'BTN GTP',
            ),
            149 => 
            array (
                'id' => 150,
                'alamat' => 'UKKE\'E',
            ),
            150 => 
            array (
                'id' => 151,
                'alamat' => 'BENTENGE',
            ),
            151 => 
            array (
                'id' => 152,
                'alamat' => 'BENTENGE/UKKEE',
            ),
            152 => 
            array (
                'id' => 153,
                'alamat' => 'SOLIE',
            ),
            153 => 
            array (
                'id' => 154,
                'alamat' => 'TONRONGE',
            ),
            154 => 
            array (
                'id' => 155,
                'alamat' => 'TAKALALA',
            ),
            155 => 
            array (
                'id' => 156,
                'alamat' => 'TAKALALA/SENTRAL',
            ),
            156 => 
            array (
                'id' => 157,
                'alamat' => 'JL.A.POTTO',
            ),
            157 => 
            array (
                'id' => 158,
                'alamat' => 'JL. MACANRE',
            ),
            158 => 
            array (
                'id' => 159,
                'alamat' => 'JL.A.PALOMPOI',
            ),
            159 => 
            array (
                'id' => 160,
                'alamat' => 'JL.A.PANNE',
            ),
            160 => 
            array (
                'id' => 161,
                'alamat' => 'JL.PASAR LAMA',
            ),
            161 => 
            array (
                'id' => 162,
                'alamat' => 'JL.MESJID RAYA',
            ),
            162 => 
            array (
                'id' => 163,
                'alamat' => 'JL.ALLIMBANGENG',
            ),
            163 => 
            array (
                'id' => 164,
                'alamat' => 'JL.AL-MUHAJIRIN',
            ),
            164 => 
            array (
                'id' => 165,
                'alamat' => 'JL.SUKARELA',
            ),
            165 => 
            array (
                'id' => 166,
                'alamat' => 'JL.SUNGAI WALANAE',
            ),
            166 => 
            array (
                'id' => 167,
                'alamat' => 'JL. LOMPENGENG',
            ),
            167 => 
            array (
                'id' => 168,
                'alamat' => 'JL.PAHLAWAN',
            ),
            168 => 
            array (
                'id' => 169,
                'alamat' => 'JL.GOTONG ROYONG',
            ),
            169 => 
            array (
                'id' => 170,
                'alamat' => 'JL.PEMILIHAN',
            ),
            170 => 
            array (
                'id' => 171,
                'alamat' => 'JL.AMAN',
            ),
            171 => 
            array (
                'id' => 172,
                'alamat' => 'JL.CABENGE',
            ),
            172 => 
            array (
                'id' => 173,
                'alamat' => 'JL.ALLAPORENG',
            ),
            173 => 
            array (
                'id' => 174,
                'alamat' => 'S.WALENNA\'E',
            ),
            174 => 
            array (
                'id' => 175,
                'alamat' => 'JL.POTTO',
            ),
            175 => 
            array (
                'id' => 176,
                'alamat' => 'MACANRE',
            ),
            176 => 
            array (
                'id' => 177,
                'alamat' => 'JL.H.A.PANNE',
            ),
            177 => 
            array (
                'id' => 178,
                'alamat' => 'LOMPENGENG',
            ),
            178 => 
            array (
                'id' => 179,
                'alamat' => 'CABENGE',
            ),
            179 => 
            array (
                'id' => 180,
                'alamat' => 'ABBANUANGE',
            ),
            180 => 
            array (
                'id' => 181,
                'alamat' => 'TETEWATU',
            ),
            181 => 
            array (
                'id' => 182,
                'alamat' => 'PALERO',
            ),
            182 => 
            array (
                'id' => 183,
                'alamat' => 'TAJUNCU',
            ),
            183 => 
            array (
                'id' => 184,
                'alamat' => 'BTN BUCCELLO',
            ),
            184 => 
            array (
                'id' => 185,
                'alamat' => 'PEPPAE, ABBANUANGE',
            ),
            185 => 
            array (
                'id' => 186,
                'alamat' => 'MANGKUTTU',
            ),
            186 => 
            array (
                'id' => 187,
                'alamat' => 'BTN BUKIT MATRA',
            ),
            187 => 
            array (
                'id' => 188,
                'alamat' => 'SALENG, ABBANUANGE',
            ),
            188 => 
            array (
                'id' => 189,
                'alamat' => 'TOGORA',
            ),
            189 => 
            array (
                'id' => 190,
                'alamat' => 'BERRU/ABBANUANGE',
            ),
            190 => 
            array (
                'id' => 191,
                'alamat' => 'DESA LABAE',
            ),
            191 => 
            array (
                'id' => 192,
                'alamat' => 'RAFILLA RESIDENCE / CIKKE',
            ),
            192 => 
            array (
                'id' => 193,
                'alamat' => 'TONRONGE, TETEWATU',
            ),
            193 => 
            array (
                'id' => 194,
                'alamat' => 'BTN KOLAM MAS INDAH',
            ),
            194 => 
            array (
                'id' => 195,
                'alamat' => 'BTN MASAGO LOLLOE',
            ),
            195 => 
            array (
                'id' => 196,
                'alamat' => 'KALAKKANG',
            ),
            196 => 
            array (
                'id' => 197,
                'alamat' => 'BTN TOMPO TOBANI',
            ),
            197 => 
            array (
                'id' => 198,
                'alamat' => 'BTN LALABATA PERMAI',
            ),
            198 => 
            array (
                'id' => 199,
                'alamat' => 'BTN SINAR MATRA',
            ),
            199 => 
            array (
                'id' => 200,
                'alamat' => 'BTN HANDAYANI LOLLOE',
            ),
            200 => 
            array (
                'id' => 304,
                'alamat' => 'SEDUTA PERMAI MALAKA',
            ),
            201 => 
            array (
                'id' => 401,
                'alamat' => 'BTN CAHAYA',
            ),
            202 => 
            array (
                'id' => 501,
                'alamat' => 'TINCO',
            ),
            203 => 
            array (
                'id' => 502,
                'alamat' => 'TETEWATU',
            ),
            204 => 
            array (
                'id' => 606,
                'alamat' => 'TAJUNCU',
            ),
            205 => 
            array (
                'id' => 607,
                'alamat' => 'PALANGISENG',
            ),
            206 => 
            array (
                'id' => 608,
                'alamat' => 'TAKAMMUTA',
            ),
            207 => 
            array (
                'id' => 609,
                'alamat' => 'LAPPA WATU WATU',
            ),
            208 => 
            array (
                'id' => 610,
                'alamat' => 'BTN GRAHA MERDEKA',
            ),
            209 => 
            array (
                'id' => 611,
                'alamat' => 'PANINCONG',
            ),
            210 => 
            array (
                'id' => 612,
                'alamat' => 'MARIO INDAH',
            ),
            211 => 
            array (
                'id' => 613,
                'alamat' => 'BTN BUKIT MALAKA',
            ),
            212 => 
            array (
                'id' => 614,
                'alamat' => 'GRAHA LAKACERE',
            ),
            213 => 
            array (
                'id' => 615,
                'alamat' => 'BTN POROS LEMPA',
            ),
            214 => 
            array (
                'id' => 616,
                'alamat' => 'TUJUH WALI WALI',
            ),
            215 => 
            array (
                'id' => 617,
                'alamat' => 'LALABATA PERMAI',
            ),
            216 => 
            array (
                'id' => 618,
                'alamat' => 'BUCCELLO',
            ),
            217 => 
            array (
                'id' => 619,
                'alamat' => 'PARENRING',
            ),
            218 => 
            array (
                'id' => 620,
                'alamat' => 'TETEWATU / TONRONGE',
            ),
            219 => 
            array (
                'id' => 621,
                'alamat' => 'PALERO / PALANGISENG',
            ),
            220 => 
            array (
                'id' => 622,
                'alamat' => 'TEGORA / PALANGISENG',
            ),
            221 => 
            array (
                'id' => 623,
                'alamat' => 'JL.NENE URANG',
            ),
            222 => 
            array (
                'id' => 624,
                'alamat' => 'BUKIT KAYANGAN',
            ),
            223 => 
            array (
                'id' => 625,
                'alamat' => 'JL.A.MAKKULAWU',
            ),
            224 => 
            array (
                'id' => 626,
                'alamat' => 'JL.BATU MASSILA',
            ),
            225 => 
            array (
                'id' => 627,
                'alamat' => 'BTN PAKANREBETE',
            ),
            226 => 
            array (
                'id' => 628,
                'alamat' => 'PAROTO',
            ),
            227 => 
            array (
                'id' => 629,
                'alamat' => 'PALERO / ABBANUANGE',
            ),
            228 => 
            array (
                'id' => 630,
                'alamat' => 'JL.A.MADE ALI',
            ),
            229 => 
            array (
                'id' => 631,
                'alamat' => 'TANETE',
            ),
            230 => 
            array (
                'id' => 632,
                'alamat' => 'TANJONGE',
            ),
            231 => 
            array (
                'id' => 633,
                'alamat' => 'LASUDU',
            ),
            232 => 
            array (
                'id' => 634,
                'alamat' => 'ALLANGKARAKENGE',
            ),
            233 => 
            array (
                'id' => 635,
                'alamat' => 'JEKKA\'E',
            ),
            234 => 
            array (
                'id' => 636,
                'alamat' => 'SAREBATUE',
            ),
            235 => 
            array (
                'id' => 637,
                'alamat' => 'PISING',
            ),
            236 => 
            array (
                'id' => 638,
                'alamat' => 'AMESANGENG',
            ),
            237 => 
            array (
                'id' => 639,
                'alamat' => 'ANAWANGENG',
            ),
            238 => 
            array (
                'id' => 640,
                'alamat' => 'ATTALIANG',
            ),
            239 => 
            array (
                'id' => 641,
                'alamat' => 'TOCAMPU',
            ),
            240 => 
            array (
                'id' => 642,
                'alamat' => 'BTN BUMI RIO BATARA',
            ),
            241 => 
            array (
                'id' => 643,
                'alamat' => 'JL.PETTA WANUA',
            ),
            242 => 
            array (
                'id' => 644,
                'alamat' => 'BTN BAITI JANNATI',
            ),
            243 => 
            array (
                'id' => 645,
                'alamat' => 'PERINTIS',
            ),
            244 => 
            array (
                'id' => 646,
                'alamat' => 'VILLA MAKNUNAK',
            ),
            245 => 
            array (
                'id' => 647,
                'alamat' => 'VILLA SANUBARI',
            ),
            246 => 
            array (
                'id' => 648,
                'alamat' => 'BTN BUMI RIO BATARA',
            ),
            247 => 
            array (
                'id' => 649,
                'alamat' => 'SEPPANG',
            ),
            248 => 
            array (
                'id' => 650,
                'alamat' => 'LR.TEMMAPAFI',
            ),
            249 => 
            array (
                'id' => 651,
                'alamat' => 'SEPPANG',
            ),
            250 => 
            array (
                'id' => 652,
                'alamat' => 'GRIYA CITRA LAPAJUNG',
            ),
            251 => 
            array (
                'id' => 653,
                'alamat' => 'SEDUTA RESIDEN MALAKA',
            ),
            252 => 
            array (
                'id' => 654,
                'alamat' => 'JL.LAMAPPOLOWARE',
            ),
            253 => 
            array (
                'id' => 655,
                'alamat' => 'ASMIL MALAKA',
            ),
            254 => 
            array (
                'id' => 656,
                'alamat' => 'PESONA ALAM OMPO',
            ),
            255 => 
            array (
                'id' => 657,
                'alamat' => 'GRIYA ALJIBATUN',
            ),
            256 => 
            array (
                'id' => 658,
                'alamat' => 'VILLA RESIDENCE',
            ),
            257 => 
            array (
                'id' => 659,
                'alamat' => 'LAKIBONG',
            ),
            258 => 
            array (
                'id' => 660,
                'alamat' => 'MALAKA/LAPPAE',
            ),
            259 => 
            array (
                'id' => 661,
                'alamat' => 'BTN LEMPA',
            ),
            260 => 
            array (
                'id' => 662,
                'alamat' => 'BTN LEMPA',
            ),
            261 => 
            array (
                'id' => 663,
                'alamat' => 'BTN ROYAL HARMONI',
            ),
            262 => 
            array (
                'id' => 664,
                'alamat' => 'GAMALAKA RESIDENCE',
            ),
            263 => 
            array (
                'id' => 665,
                'alamat' => 'CITTA',
            ),
            264 => 
            array (
                'id' => 666,
                'alamat' => 'SEDUTA LAND LAPPAE',
            ),
            265 => 
            array (
                'id' => 667,
                'alamat' => 'PAKANREBETE/GAPIS',
            ),
        ));
        
        
    }
}