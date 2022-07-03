<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPajakRumahMakan
 */
class ObjekPajakRumahMakan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'objek_pajak_rumah_makan';
    protected $fillable = ['objek_pajak_id','izin'];

    public function objekpajak()
    {
        return $this->belongsTo(ObjekPajak::class,'objek_pajak_id','id');
    }

}
