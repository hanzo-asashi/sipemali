<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LaporanController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Master\Alamat\ListAlamat;
use App\Http\Livewire\Master\Bank\ListBank;
use App\Http\Livewire\Master\Golongan\ListGolongan;
use App\Http\Livewire\Master\Loket\ListLoket;
use App\Http\Livewire\Master\MetodeBayar\ListMetodeBayar;
use App\Http\Livewire\Master\Pelanggan\CreatePelanggan;
use App\Http\Livewire\Master\Pelanggan\EditPelanggan;
use App\Http\Livewire\Master\Pelanggan\ListPelanggan;
use App\Http\Livewire\Master\Pelanggan\ShowPelanggan;
use App\Http\Livewire\Master\Status\ListStatus;
use App\Http\Livewire\Master\StatusPembayaran\ListStatusPembayaran;
use App\Http\Livewire\Master\Zona\ListZona;
use App\Http\Livewire\PencatatanMeter;
use App\Http\Livewire\Pengaturan\Activity\ListActivity;
use App\Http\Livewire\Pengaturan\Permissions\ListPermissions;
use App\Http\Livewire\Pengaturan\Roles\ListRoles;
use App\Http\Livewire\Pengaturan\Setting\ListSetting;
use App\Http\Livewire\Pengaturan\Users\ListUsers;
use App\Http\Livewire\Select2Dropdown;
use App\Http\Livewire\Transaksi\Pembayaran\CreatePembayaran;
use App\Http\Livewire\Transaksi\Pembayaran\DetailPembayaran;
use App\Http\Livewire\Transaksi\Pembayaran\EditPembayaran;
use App\Http\Livewire\Transaksi\Pembayaran\ListPembayaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route Qrcode View
//Route::get('/qrcode/{wpid}', QrviewController::class)->name('qrcode');
//Route::controller(\App\Http\Controllers\LandingController::class)->name('landing.')->group(function () {
//    Route::get('/', 'index');
//});

Route::group(['middleware' => 'auth:web','verified', \Spatie\Honeypot\ProtectAgainstSpam::class], function () {
//    Route::get('/', Dashboard::class)->name('home');

    // locale Route
//    Route::get('lang/{locale}', [LanguageController::class, 'swap']);

    // Route Catat Meter
    Route::get('catat-meter', PencatatanMeter::class)->name('catat-meter');

//    Route::get('/load', Select2Dropdown::class)->name('load');

//    Route::controller(\App\Http\Controllers\DatatableController::class)->prefix('data')->name('dt.')->group(function () {
//        Route::get('umur-piutang', 'getUmurPiutangPelangganData')->name('umur-piutang');
//    });

    // Route Transaksi
    Route::prefix('transaksi')->name('transaksi.')->group(function (){
        Route::name('pembayaran.')->prefix('pembayaran')->group(function () {
            Route::get('/', ListPembayaran::class)->name('list');
            Route::get('/create', CreatePembayaran::class)->name('create');
            Route::get('/{id}/edit', EditPembayaran::class)->name('edit');
            Route::get('/{id}/detail', DetailPembayaran::class)->name('detail');
        });
    });

    // Route Laporan
    Route::prefix('laporan')->name('laporan.')->group(function (){
        Route::get('/', [LaporanController::class,'index'])->name('list');
        Route::get('/daftar-rekening-ditagih', [LaporanController::class,'daftarRekeningDitagih'])->name('daftar-rekening-ditagih');
        Route::get('/piutang-pelanggan', [LaporanController::class,'piutangPelanggan'])->name('piutang-pelanggan');
        Route::get('/piutang-kelompok', [LaporanController::class,'piutangKelompok'])->name('piutang-kelompok');
        Route::get('/opname-fisik', [LaporanController::class,'opnameFisik'])->name('opname-fisik');
        Route::get('/umur-piutang-pelanggan', [LaporanController::class,'umurPiutangPelanggan'])->name('umur-piutang-pelanggan');
        Route::get('/umur-piutang-kelompok', [LaporanController::class,'umurPiutangKelompok'])->name('umur-piutang-kelompok');
        Route::get('/rekening-air', [LaporanController::class,'rekeningAir'])->name('rekening-air');
        Route::get('/pelanggan', [LaporanController::class,'pelanggan'])->name('pelanggan');
        Route::get('/perhitungan', [LaporanController::class,'perhitungan'])->name('perhitungan');
        Route::get('/penerimaan-penagihan', [LaporanController::class,'penerimaanPenagihan'])->name('penerimaan-penagihan');
    });

    // Route Cetak
    Route::prefix('cetak')->name('cetak.')->group(function (){
        Route::get('/', [CetakController::class,'index'])->name('index');
        Route::get('transaksi', [CetakController::class,'transaksi'])->name('transaksi');
        Route::get('/preview', [CetakController::class,'preview'])->name('preview');
        Route::get('/bukti-pembayaran/{page}/{pelangganId}/{pembayaranId}', [CetakController::class,'showBuktiBayar'])->name('bukti-pembayaran');
    });
    // Route Export
    Route::prefix('export')->name('export.')->group(function (){
        Route::get('/', [ExportController::class,'index'])->name('index');
    });

    // Master Route
    Route::prefix('master')->name('master.')->group(function (){
        Route::name('pelanggan.')->prefix('pelanggan')->group(function () {
            Route::get('/', ListPelanggan::class)->name('list');
            Route::get('/create', CreatePelanggan::class)->name('create');
            Route::get('/{id}/edit', EditPelanggan::class)->name('edit');
            Route::get('/{id}/show', ShowPelanggan::class)->name('show');
//            Route::get('/show', ShowPelanggan::class)->name('show');
        });
        Route::name('alamat.')->prefix('alamat')->group(function () {
            Route::get('/', ListAlamat::class)->name('list');
        });
        Route::name('metode-bayar.')->prefix('metode-bayar')->group(function () {
            Route::get('/', ListMetodeBayar::class)->name('list');
        });
        Route::name('golongan.')->prefix('golongan')->group(function () {
            Route::get('/', ListGolongan::class)->name('list');
        });
        Route::name('zona.')->prefix('zona')->group(function () {
            Route::get('/', ListZona::class)->name('list');
        });
        Route::name('status.')->prefix('status')->group(function () {
            Route::get('/', ListStatus::class)->name('list');
        });
        Route::name('status-pembayaran.')->prefix('status-pembayaran')->group(function () {
            Route::get('/', ListStatusPembayaran::class)->name('list');
        });
        Route::name('loket.')->prefix('loket')->group(function () {
            Route::get('/', ListLoket::class)->name('list');
        });
        Route::name('bank.')->prefix('bank')->group(function () {
            Route::get('/', ListBank::class)->name('list');
        });
    });

    // Pengaturan Route
    Route::prefix('pengaturan')->name('pengaturan.')->group(function (){
        Route::name('activity.')->prefix('activity')->group(function () {
            Route::get('/', ListActivity::class)->name('list');
        });
        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', ListUsers::class)->name('list');
        });
        Route::name('roles.')->prefix('roles')->group(function () {
            Route::get('/', ListRoles::class)->name('list');
        });
        Route::name('permission.')->prefix('permission')->group(function () {
            Route::get('/', ListPermissions::class)->name('list');
        });
        Route::name('setting.')->prefix('setting')->group(function () {
            Route::get('/', ListSetting::class)->name('list');
        });
    });
});
