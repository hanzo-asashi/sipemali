<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekJenisPajak
 */
class ObjekJenisPajak extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'objek_jenis_pajak';
    protected $fillable = ['objek_pajak_id','jenis_objek_pajak'];
}
