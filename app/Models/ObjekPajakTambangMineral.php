<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPajakTambangMineral
 */
class ObjekPajakTambangMineral extends Model
{
    use HasFactory;

    protected $table = 'objek_pajak_tambang_mineral';
    protected $fillable
        = [
            'objek_pajak_id',
            'tanggal_setoran',
            'nama_wajib_pajak',
            'jenis_pekerjaan',
            'opd_penanggungjawab_anggaran',
            'no_kontrak',
            'tahun_berdasarkan_kontrak',
            'nilai_kontrak',
            'status',
            'keterangan',
        ];

    protected $casts = [
        'tanggal_setoran' => 'datetime'
    ];

    public function bahanbaku()
    {
        return $this->hasMany(BahanBakuTambang::class, 'id_objek_pajak', 'id');
    }


    public function objekPajak()
    {
        return $this->belongsTo(ObjekPajak::class, 'objek_pajak_id', 'id');
    }

}
