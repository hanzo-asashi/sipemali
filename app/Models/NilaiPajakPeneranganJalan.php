<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

/**
 * @mixin IdeHelperNilaiPajakPeneranganJalan
 */
class NilaiPajakPeneranganJalan extends Model
{
    use HasFactory, HasStatuses;

    protected $table = 'nilai_pajak_penerangan_jalan';
    protected $fillable = ['id_objek_pajak','triwulan','tahun','besaran_kwh','nilai_pajak','metode_bayar','status'];

    public function objekpajak()
    {
        return $this->belongsTo(ObjekPajak::class,'id_objek_pajak','id');
    }
}
