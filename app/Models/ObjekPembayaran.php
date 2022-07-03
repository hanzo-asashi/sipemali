<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPembayaran
 */
class ObjekPembayaran extends Model
{
    use HasFactory;

    protected $table = 'objek_pembayaran';

    public $fillable = [
        'pembayaran_id','objek_pajak_id'
    ];
}
