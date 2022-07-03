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
];
