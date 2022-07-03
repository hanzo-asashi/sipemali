<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperObjekPajakHotel
 */
class ObjekPajakHotel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'objek_pajak_hotel';
    protected $fillable = ['izin','objek_pajak_id'];

}
