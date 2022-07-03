<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAnggaranOpd
 */
class AnggaranOpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_id','nama_opd','nilai_pagu','nilai_pagu_htl','nilai_pagu_rm','target_pajak','target_pajak_rm',
        'target_pajak_htl','realisasi','realisasi_rm','realisasi_htl','tahun','jenis_anggaran'
    ];

    public function opd()
    {
        return $this->hasOne(DaftarOpd::class,'id','opd_id');
    }

    public function belanja()
    {
        return $this->hasMany(BelanjaOpd::class,'opd_id','opd_id');
    }



    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nilai_pagu', 'like', $term)
            ->orWhere('nilai_pagu_htl', 'like', $term)
            ->orWhere('nilai_pagu_rm', 'like', $term)
            ->orWhere('target_pajak', 'like', $term)
            ->orWhere('target_pajak_rm', 'like', $term)
            ->orWhere('target_pajak_htl', 'like', $term)
            ->orWhere('realisasi', 'like', $term)
            ->orWhere('realisasi_rm', 'like', $term)
            ->orWhere('realisasi_htl', 'like', $term)
            ->orWhere('tahun', 'like', $term)
            ->orWhereHas('opd', function ($query) use ($term) {
                $query->where('nama_opd', 'like', $term);
            })
        ;
    }
}
