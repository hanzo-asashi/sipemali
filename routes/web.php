<?php

use App\Http\Controllers\Account\HakAksesController;
use App\Http\Controllers\Account\PenggunaController;
use App\Http\Controllers\Account\TipeAksesController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObjekPajakController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\QrviewController;
use App\Http\Controllers\Tracking;
use App\Http\Controllers\WajibPajakController;
use App\Http\Livewire\Components\DarkModeSwitch;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Master\TargetPajak\Table as TargetTable;
use App\Http\Livewire\Pengguna\UserProfile;
use App\Http\Livewire\TransaksiOpd\AnggaranOpd;
use App\Http\Livewire\TransaksiOpd\BelanjaOpd;
use App\Http\Livewire\TransaksiPajak\Pembayaran\CreatePembayaran;
use App\Http\Livewire\TransaksiPajak\Pembayaran\Hotel\DetailBayarHotel;
use App\Http\Livewire\TransaksiPajak\Pembayaran\Hotel\Table as HotelTable;
use App\Http\Livewire\TransaksiPajak\Pembayaran\PeneranganJalanUmum\DetailBayarPju;
use App\Http\Livewire\TransaksiPajak\Pembayaran\PeneranganJalanUmum\Table as PeneranganTabel;
use App\Http\Livewire\TransaksiPajak\Pembayaran\Reklame\DetailBayarReklame;
use App\Http\Livewire\TransaksiPajak\Pembayaran\Reklame\Table as ReklameTabel;
use App\Http\Livewire\TransaksiPajak\Pembayaran\RumahMakan\DetailBayarRumahMakan;
use App\Http\Livewire\TransaksiPajak\Pembayaran\RumahMakan\RumahMakanTable;
use App\Http\Livewire\TransaksiPajak\Pembayaran\TambangMineral\DetailBayarTambang;
use App\Http\Livewire\TransaksiPajak\Pembayaran\TambangMineral\Table as TambangTabel;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

// Route Qrcode View
Route::get('/qrcode/{wpid}', QrviewController::class)->name('qrcode');

// Route Landing View
Route::get('/', [LandingController::class,'index'])->name('home');
Route::get('/search', [LandingController::class,'searchTracking'])->name('search');
Route::get('/tracking', [Tracking::class,'index'])->name('tracking');

// Route Verifikasi Pendaftaran Pengguna
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // Route Pengguna
    Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('pengguna/tambah', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::get('pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::get('pengguna/eksport', [PenggunaController::class, 'create'])->name('pengguna.eksport');
    Route::get('pengguna/profil', UserProfile::class)->name('pengguna.profile');

    // Route Roles
    Route::resource('hak-akses', HakAksesController::class);
    Route::resource('tipe-akses', TipeAksesController::class);

    // Route Wajib Pajak Dan Objek Pajak
    Route::resource('wajib-pajak', WajibPajakController::class);
    Route::resource('objek-pajak', ObjekPajakController::class);

    // Route Master Data Pokok
    Route::view('jenis-wajib-pajak', 'master.jenis-pajak.index')
        ->name('jenis-wajib-pajak.index');
    Route::view('jenis-objek-pajak', 'master.jenis-objek-pajak.index')
        ->name('jenis-objek-pajak.index');
    Route::view('kategori-reklame', 'master.kategori-reklame.index')
        ->name('kategori-reklame.index');
    Route::view('tipe-usaha-reklame', 'master.tipe-usaha-reklame.index')
        ->name('tipe-usaha-reklame.index');
    Route::view('jenis-reklame', 'master.jenis-reklame.index')
        ->name('jenis-reklame.index');
    Route::view('tipe-satuan', 'master.tipe-satuan.index')
        ->name('tipe-satuan.index');
    Route::view('jenis-tarif', 'master.jenis-tarif.index')
        ->name('jenis-tarif.index');
    Route::view('jenis-bahan-baku-mineral', 'master.jenis-bahanbaku-mineral.index')
        ->name('jenis-bahan-baku-mineral.index');
    Route::view('jenis-metode-bayar', 'master.jenis-metode-bayar.index')
        ->name('jenis-metode-bayar.index');
    Route::view('data-opd', 'master.data-opd.index')->name('data-opd.index');
    Route::get('target-pajak', TargetTable::class)->name('master.targetpajak');

    // Tambah Pembayaran
    Route::get('pembayaran/tambah', CreatePembayaran::class)->name('pembayaran.tambah');

    // Rumah Makan Route
    Route::get('pembayaran/rumah-makan/{id}', RumahMakanTable::class)->name('pembayaran.rumahmakan');
    Route::get('pembayaran/rumah-makan/detail-bayar/{objekpajak}', DetailBayarRumahMakan::class)
        ->name('pembayaran.rumahmakan.detail');

    // Hotel Route
    Route::get('pembayaran/hotel/{id}', HotelTable::class)->name('pembayaran.hotel');
    Route::get('pembayaran/hotel/detail-bayar/{objekpajak}', DetailBayarHotel::class)
        ->name('pembayaran.hotel.detail');

    // Reklame Route
    Route::get('pembayaran/reklame/{id}', ReklameTabel::class)->name('pembayaran.reklame');
    Route::get('pembayaran/reklame/detail-bayar/{objekpajak}', DetailBayarReklame::class)
        ->name('pembayaran.reklame.detail');

    // Tambang Mineral Route
    Route::get('pembayaran/tambang-mineral/{id}', TambangTabel::class)
        ->name('pembayaran.tambangmineral');
    Route::get('pembayaran/tambang-mineral/detail-bayar/{objekpajak}', DetailBayarTambang::class)
        ->name('pembayaran.tambangmineral.detail');

    // Penerangan Jalan Umum Route
    Route::get('pembayaran/pajak-penerangan-jalan/{id}', PeneranganTabel::class)
        ->name('pembayaran.peneranganjalanumum');
    Route::get('pembayaran/pajak-penerangan-jalan/detail-bayar/{objekpajak}', DetailBayarPju::class)
        ->name('pembayaran.peneranganjalanumum.detail');

//    Route::resource('pembayaran', PembayaranController::class);
    Route::view('tunggakan', 'transaksi-pajak.tunggakan.index')->name('tunggakan.index');

    // Route Transaksi OPD
    Route::get('/anggaran-opd', AnggaranOpd::class);
    Route::get('/belanja-opd', BelanjaOpd::class);

    // Route Pengaturan
    Route::resource('pengaturan', PengaturanController::class);

    // Route Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/realisasi', [LaporanController::class, 'realisasi'])->name('laporan.realisasi');
    Route::get('laporan/jenis-pajak', [LaporanController::class, 'jenisPajak'])->name('laporan.jenispajak');
    Route::get('laporan/wilayah', [LaporanController::class, 'wilayah'])->name('laporan.wilayah');
    Route::get('laporan/metode-pembayaran', [LaporanController::class, 'metodeBayar'])->name('laporan.metodebayar');
    Route::get('laporan/realisasi-opd', [LaporanController::class, 'realisasiOpd'])->name('laporan.realisasiopd');
    Route::get('laporan/belanja-opd', [LaporanController::class, 'belanjaOpd'])->name('laporan.belanjaopd');
    Route::get('laporan/tambang-mineral', [LaporanController::class, 'tambangMineral'])->name('laporan.tambangmineral');

    // Route Print Laporan
    Route::get('laporan/preview', [LaporanController::class, 'showPrintPage'])->name('laporan.preview');
    Route::get('laporan/export-excel', [LaporanController::class, 'exportToExcel'])->name('laporan.export-excel');
    // Route Cetak Bukti SKPD dan STS
    Route::get('pembayaran/cetak-bukti/preview/{page}/{bayarid}', [LaporanController::class, 'showPrintBukti'])->name('laporan.bukticetak');
    // Eksport PDF
    Route::get('laporan/download/{page}', [LaporanController::class, 'downloadPdf'])
        ->name('laporan.downloadpdf');

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])
        ->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])
        ->name('updatePassword');

    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
    // Dark Mode Route
    Route::get('dark-mode', DarkModeSwitch::class);
    //Language Translation
    Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

    //Print
    Route::get('print-wajib-pajak', [PrintController::class, 'printwp'])->name('wajib-pajak.print');
    Route::get('print-objek-pajak', [PrintController::class, 'printop'])->name('objek-pajak.print');
    Route::get('cetak-pembayaran', [PrintController::class, 'cetakPembayaran'])->name('transaksi-pajak.pembayaran.print');
    Route::get('cetak-pembayaran-rumah-makan', [PrintController::class, 'cetakPembayaranRm'])->name('transaksi-pajak.pembayaran-rm.print');
    Route::get('cetak-pembayaran-hotel', [PrintController::class, 'cetakPembayaranHtl'])->name('transaksi-pajak.pembayaran-htl.print');
    Route::get('cetak-pembayaran-reklame', [PrintController::class, 'cetakPembayaranRkl'])->name('transaksi-pajak.pembayaran-rkl.print');
    Route::get('cetak-pembayaran-tambang-mineral', [PrintController::class, 'cetakPembayaranTmb'])->name('transaksi-pajak.pembayaran-tmb.print');
    Route::get('cetak-pembayaran-penerangan-jalan', [PrintController::class, 'cetakPembayaranPpj'])->name('transaksi-pajak.pembayaran-ppj.print');
    Route::get('print-tunggakan-pajak', [PrintController::class, 'printtunggakan'])->name('transaksi-pajak.tunggakan.print');
});
