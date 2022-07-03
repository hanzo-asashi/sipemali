<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTargetPajak
 */
class TargetPajak extends Model
{
    use HasFactory;

    public $table = 'target_pajaks';
    public $timestamps = false;
    protected $fillable = ['tahun_pajak', 'id_jenis_objek_pajak','target'];

    public function jenisObjekPajak()
    {
        return $this->hasOne(JenisObjekPajak::class,'id','id_jenis_objek_pajak');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('tahun_pajak', 'like', $term)
            ->orWhere('target', 'like', $term)
            ->orWhereHas('jenisObjekPajak', function ($query) use ($term) {
                $query->where('nama_jenis_op', 'like', $term);
            })
        ;
    }
}
