<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $data = $this->data();

        foreach ($data as $value) {
            Permission::create([
                'name' => $value['name'],
            ]);
        }
    }

    public function data(): array
    {
        $data = [];
        // list of model permission
        $model = [
            'user', 'role', 'permission','laporan','wajib-pajak',
            'objek-pajak','transaksi-pajak','transaksi-opd','jenis-wajib-pajak',
            'jenis-objek-pajak','jenis-bahan-baku','jenis-metode-pembayaran','pengaturan',
            'jenis-reklame','tipe-reklame','tipe-satuan','jenis-tarif','kategori-reklame',
            'tipe-usaha-reklame','tunggakan','pembayaran','anggaran-opd','belanja-opd'
        ];

        foreach ($model as $value) {
            foreach ($this->crudActions($value) as $action) {
                $data[] = ['name' => $action];
            }
        }

        return $data;
    }

    public function crudActions($name): array
    {
        $actions = [];
        // list of permission actions
        $crud = ['create', 'read', 'update', 'delete','manage','detail','show',
            'force-delete','restore','backup','eksport','import','bulk-actions'
        ];

        foreach ($crud as $value) {
            $actions[] = $value.' '.$name;
        }

        return $actions;
    }
}
