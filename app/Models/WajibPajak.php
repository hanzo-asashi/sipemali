<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperWajibPajak
 */
class WajibPajak extends Model
{
    use SoftDeletes;

    protected $table = 'wajib_pajak';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis_wp',
        'nama_wp',
        'nik_nib',
        'nwpd',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat',
        'telepon',
        'email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    //observe this model being deleted and delete the child events
//    public static function boot ()
//    {
//        parent::boot();
//
//        self::deleting(function (ObjekPajak $objekPajak) {
//
//            foreach ($objekPajak->events as $event)
//            {
//                $event->delete();
//            }
//        });
//    }

    public function jenisWajibPajak()
    {
        return $this->hasOne(JenisWajibPajak::class, 'id', 'id_jenis_wp');
    }

    public function objekpajak()
    {
        return $this->hasMany(ObjekPajak::class, 'id_wp', 'id');
    }

    public function objekpajaktambang()
    {
        return $this->hasManyThrough(ObjekPajak::class, ObjekPajakTambangMineral::class,'objek_pajak_id', 'id');
    }

    public function objekpajakrumahmakan()
    {
        return $this->hasManyThrough(ObjekPajak::class,ObjekPajakRumahMakan::class,'objek_pajak_id','id');
    }

    public function pembayaran()
    {
        return $this->hasManyThrough(PembayaranPajak::class, ObjekPajak::class,'id', 'objek_pajak_id');
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

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where(function ($q) use ($term) {
            $q->where('nama_wp', 'like', $term)
                ->orWhere('nik_nib', 'like', $term)
                ->orWhere('nwpd', 'like', $term)
                ->orWhere('alamat', 'like', $term)
                ->orWhere('telepon', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhereHas('objekpajak',function ($query) use ($term){
                    $query->where('nopd','like', $term);
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
