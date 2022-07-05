<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperObjekPajak
 */
class ObjekPajak extends Model
{
    use HasFactory;
    use softDeletes;


    protected $table = 'objek_pajak';

    protected $fillable = [
        'id_wp','id_jenis_op','nomor_skpd','nomor_sts','nopd','nama_objek_pajak','kabupaten','kecamatan','kelurahan','alamat','keterangan'
    ];

    public static function getNamaObjekPajak($id)
    {
        if(!is_null($id)){
            $nama = self::find($id)->nama_objek_pajak;
        }
        return $nama ?? '';
    }

    public function is_wajibpajak()
    {
        return $this->wajibpajak()->count() > 0;
    }

    public function is_pembayaran()
    {
        return $this->pembayaran->isNotEmpty() && !is_null($this->pembayaran());
    }

    public function is_jenisObjekPajak()
    {
        return $this->jenisObjekPajak()->count() > 0;
    }

    public function wajibpajak()
    {
        return $this->belongsTo(WajibPajak::class,'id_wp','id');
    }

    public function jenisObjekPajak()
    {
        return $this->belongsTo(JenisObjekPajak::class,'id_jenis_op','id');
    }

    public function pembayaran()
    {
        return $this->hasMany(PembayaranPajak::class,'objek_pajak_id','id')->orderByDesc('tahun')->orderByDesc('bulan');
    }

    public function objekpembayaran()
    {
        return $this->belongsToMany(ObjekPembayaran::class,'objek_pembayaran','id','objek_pajak_id');
    }

    public function kab()
    {
        return $this->belongsTo(Wilayah::class, 'kabupaten', 'kode');
    }

    public function kec()
    {
        return $this->belongsTo(Wilayah::class, 'kecamatan', 'kode');
    }

    public function kel()
    {
        return $this->belongsTo(Wilayah::class, 'kelurahan', 'kode');
    }

    public function nilaipajakpju()
    {
        return $this->hasOne(NilaiPajakPeneranganJalan::class,'id_objek_pajak','id');
    }

    public function objekPajakRumahMakan()
    {
        return $this->hasMany(ObjekPajakRumahMakan::class,'objek_pajak_id','id');
    }

    public function objekPajakHotel()
    {
        return $this->hasMany(ObjekPajakHotel::class,'objek_pajak_id','id');
    }

    public function objekPajakTambang()
    {
        return $this->hasMany(ObjekPajakTambangMineral::class,'objek_pajak_id','id');
    }

    public function bahanbakutambang()
    {
        return $this->hasManyThrough(BahanBakuTambang::class,ObjekPajakTambangMineral::class, 'id','id_objek_pajak');
//        return $this->belongsTo(BahanBakuTambang::class,ObjekPajak::class, 'id','id_objek_pajak');
//        return $this->hasMany(BahanBakuTambang::class, 'id_objek_pajak','id_jenis_op');
    }

    public function jenisbahanbaku()
    {
        return $this->hasManyThrough(BahanBakuTambang::class,JenisBahanBakuMineral::class, 'id','id_jenis_bahan_baku');
    }

    public function objekPajakReklame()
    {
        return $this->hasMany(ObjekPajakReklame::class,'objek_pajak_id','id');
    }

    public function objekPajakPju()
    {
        return $this->hasMany(ObjekPajakPeneranganJalanUmum::class,'objek_pajak_id','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where(function ($q) use ($term) {
            $q->where('nama_objek_pajak', 'like', $term)
                ->orWhere('nopd', 'like', $term)
                ->orWhere('alamat', 'like', $term)
                ->orWhereHas('pembayaran', function ($query) use ($term) {
                    $query->where('bulan','=', $term)
                        ->orWhere('tahun','=', $term)
                    ;
                })
                ->orWhereHas('jenisObjekPajak', function ($query) use ($term) {
                    $query->where('nama_jenis_op', 'like', $term);
                })
                ->orWhereHas('wajibpajak', function ($query) use ($term) {
                    $query->where('nama_wp', 'like', $term);
                })
                ->orWhereHas('kab', function ($query) use ($term) {
                    $query->where('nama', 'like', $term);
                })
                ->orWhereHas('kec', function ($query) use ($term) {
                    $query->where('nama', 'like', $term);
                })
                ->orWhereHas('kel', function ($query) use ($term) {
                    $query->where('nama', 'like', $term);
                });
        });
    }
}
