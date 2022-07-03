<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPajakPeneranganJalanUmum
 */
class ObjekPajakPeneranganJalanUmum extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'objek_pajak_penerangan_jalan_umum';
    protected $fillable = ['objek_pajak_id','nama_wilayah','triwulan','besaran_kwh','nilai_pajak','tahun_pajak_ppj'];
}
