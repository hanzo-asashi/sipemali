<?php

return [
    'data-sidebar'            => ['enable' => true, 'content' => 'data-sidebar-'], // Options[String]: vertical(default), horizontal
    'theme'                   => env('APP_THEME', 'light'), // options[String]: 'light'(default), 'dark', 'brand'
    'social-login'            => false,
    'page-loader'             => env('PAGE_LOADER', 'pace-done'),
    'perPage'                 => [10, 20, 25, 50, 100],
    'status_aktif'            => [0 => 'Non Aktif', 1 => 'Aktif'],
    'status_bayar'            => [0 => 'Belum Lunas', 1 => 'Lunas'],
    'status_obj'              => ['Belum Lunas' => 'Belum Lunas', 'Lunas' => 'Lunas'],
    'status_pembayaran'       => ['Pending', 'Completed', 'On Hold'],
    'status_transaksi'        => [0 => 'Normal', 1 => 'Menunggak'],
    'status_tunggakan'        => [0 => 'Dalam Masa', 1 => 'Lewat Jatuh Tempo'],
    'periode_penarikan_pajak' => ['tahun' => 'Tahun', 'bulan' => 'Bulan'],
    'triwulan'                => [
        'pertama' => 'Triwulan Pertama',
        'kedua'   => 'Triwulan Kedua',
        'ketiga'  => 'Triwulan Ketiga',
        'keempat' => 'Triwulan Keempat',
    ],
    'tahun_kontrak'           => [
        '2020' => '2020',
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023',
        '2024' => '2024',
        '2025' => '2025'
    ],
    'bulan'                   => [
        '1'  => 'Januari',
        '2'  => 'Februari',
        '3'  => 'Maret',
        '4'  => 'April',
        '5'  => 'Mei',
        '6'  => 'Juni',
        '7'  => 'Juli',
        '8'  => 'Agustus',
        '9'  => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ],
    'alpinejs-version2'       => false,
    'array-data'              => [
        'jenis_wajib_pajak'  => ['Perorangan', 'Perusahaan'],
        'periode_pembayaran' => [1 => 'Hari', 2 => 'Minggu', 3 => 'Tahun'],
    ],
    'page_count' => 15,
    'use_global_search' => true,
    'use_fontawesome_pro' => true, // options[Boolean]: true, false(default)
    'use_fontawesome' => false, // options[Boolean]: true, false(default)
    'use_fontawesome6' => false, // options[Boolean]: true, false(default)
    'use_feathericon' => true, // options[Boolean]: true, false(default)
    'use_cdn_alpinejs3' => true,
    'showLanguageNav' => false,
    'list_bulan' => [
        1 => 'JAN',
        2 => 'FEB',
        3 => 'MAR',
        4 => 'APR',
        5 => 'MEI',
        6 => 'JUN',
        7 => 'JUL',
        8 => 'AGS',
        9 => 'SEP',
        10 => 'OKT',
        11 => 'NOV',
        12 => 'DES',
    ],
    'list_tahun' => [
        now()->year - 5 => now()->year - 5,
        now()->year - 4 => now()->year - 4,
        now()->year - 3 => now()->year - 3,
        now()->year - 2 => now()->year - 2,
        now()->year - 1 => now()->year - 1,
        now()->year => now()->year,
        now()->year + 1 => now()->year + 1,
        now()->year + 2 => now()->year + 2,
        now()->year + 3 => now()->year + 3,
        now()->year + 4 => now()->year + 4,
        now()->year + 5 => now()->year + 5,
    ],
    'consumer_key_bri_live' => 'P0wIZcDkRisE5VUmq7OAG8aFpQAnRbVq',
    'consumer_secret_key_bri_live' => 'EpUw6cZPx7prWhAx',
    'consumer_key_bri_sandbox' => 'xq44OU5c120VDyHXGiTTRUAFyQadxsmT',
    'consumer_secret_key_bri_sandbox' => 'baVm9LHwL7XPSk15',
    'bri_snap_key' => '---- BEGIN SSH2 PUBLIC KEY ----
                        Comment: "rsa-key-20220501"
                        AAAAB3NzaC1yc2EAAAADAQABAAABAQC/g64MXwbQRWOTTyjnPBAOke/T2fQTXGOt
                        laZdJ3zQ0tox3ULsm5xgfWe8FYFfXhcV/2XFmFC22eXFI3qOdFbOqreq1G9/fKmv
                        3TVjIvgQ7HKM96ggFFrO1rsI7++d4H5UROprNWHVHUpHE06lDpI+cLLZ2VAtHu6t
                        jhlU5TqulrhxGX+rDfQa3Yij5cvsuTM4QvHqiM8fTRrNyXLQo5qCvjs3XCOMXqig
                        nuCtWsKTfbhI5sK14A6pfnilDkAFjuhkw+pONonUTN4Y08V6ZGrsTzCE/po6Su9y
                        uSHCR4fZBg58rVKLkrn+JddW4/juBdL54AmMxwu0Pdqm0KuiKEFL
                        ---- END SSH2 PUBLIC KEY ----
                        '
];
