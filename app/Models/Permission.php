<?php

namespace App\Models;

use App\Utilities\Helpers;
use JetBrains\PhpStorm\Pure;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @mixin IdeHelperPermission
 */
class Permission extends SpatiePermission
{
    protected $fillable = [
        'name', 'guard_name',
    ];

    public static function defaultCrud(): array
    {
        return  ['create', 'update', 'delete', 'manage', 'detail', 'show', 'eksport', 'import'];
    }

    public static function defaultModel(): array
    {
        return Helpers::getAppModels('Models')->map(function ($model) {
            return \Str::lower($model);
        })->toArray();
    }

    public static function defaultPermissions(): array
    {
        $data = [];
        // list of model permission
//        $model = [
//            'user', 'role', 'permission','laporan-pajak','pembayaran','address','customers','golongan_tarif',
//            'payment','payment-status','setting','status','zona','metode_bayar'
//        ];
        $model = self::defaultModel();

        foreach ($model as $value) {
            foreach ((new Permission())->crudActions($value) as $action) {
                $data[] = ['name' => $action];
            }
        }

        return $data;
    }

    #[Pure]
 public function crudActions($name): array
 {
     $actions = [];
     // list of permission actions
     $crud = self::defaultCrud();

     foreach ($crud as $value) {
         $actions[] = $value.'_'.$name;
     }

     return $actions;
 }

    public function scopeSearch($query, $term): void
    {
        $term = "%{$term}%";
        $query->where('name', 'like', $term);
    }

//    public static function defaultPermissions(): array
//    {
//        $data = [];
//        // list of model permission
//        $model = [
//            'user', 'role', 'permission','laporan-pajak','wajib-pajak',
//            'objek-pajak','transaksi-pajak','transaksi-opd','jenis-wajib-pajak',
//            'jenis-objek-pajak','jenis-bahan-baku','jenis-metode-pembayaran','pengaturan',
//            'jenis-reklame','tipe-reklame','tipe-satuan','jenis-tarif','kategori-reklame',
//            'tipe-usaha-reklame','tunggakan','pembayaran','anggaran-opd','belanja-opd'
//        ];
//
//        foreach ($model as $value) {
//            foreach ((new Permission())->crudActions($value) as $action) {
//                $data[] = ['name' => $action];
//            }
//        }
//
//        return $data;
//    }

//    public function crudActions($name): array
//    {
//        $actions = [];
//        // list of permission actions
//        $crud = ['create', 'read', 'update', 'delete','manage','detail','show',
//            'force-delete','restore','backup','eksport','import','bulk-actions'];
//
//        foreach ($crud as $value) {
//            $actions[] = $value.' '.$name;
//        }
//
//        return $actions;
//    }
//
//    public function scopeSearch($query, $term)
//    {
//        $term = "%{$term}%";
//        $query->where('name', 'like', $term)
//        ;
//    }
}
