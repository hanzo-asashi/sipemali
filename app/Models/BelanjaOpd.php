<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBelanjaOpd
 */
class BelanjaOpd extends Model
{
    use HasFactory;

    protected $casts = [
        'periode' => 'date:Y-m-d'
    ];

    protected $fillable = [
        'opd_id','objek_pajak_id','jenis_belanja','jumlah_transaksi','jumlah_pajak','bulan','tahun','periode'
    ];

//    protected $dateFormat = 'Y-m-d';

    public function opd()
    {
        return $this->hasOne(DaftarOpd::class,'id','opd_id');
    }

    public function anggaran()
    {
        return $this->hasMany(AnggaranOpd::class,'opd_id','opd_id');
    }

    public function objekPajak()
    {
//        return $this->hasOne(ObjekPajak::class,'id','objek_pajak_id');
        return $this->hasMany(ObjekPajak::class,'id','objek_pajak_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('jenis_belanja', 'like', $term)
            ->orWhere('jumlah_transaksi', 'like', $term)
            ->orWhere('jumlah_pajak', 'like', $term)
            ->orWhereHas('opd', function ($query) use ($term) {
                $query->where('nama_opd', 'like', $term);
            })
            ->orWhereHas('objekPajak', function ($query) use ($term) {
                $query->where('nama_objek_pajak', 'like', $term);
            })
        ;
    }
}
