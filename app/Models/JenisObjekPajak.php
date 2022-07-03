<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJenisObjekPajak
 */
class JenisObjekPajak extends Model
{
    use HasFactory;

    public $table = 'jenis_objek_pajak';
    public $timestamps = false;
    protected $fillable = ['nama_jenis_op', 'shortcode', 'no_rekening'];

    public static function getNamaJenisObjekPajak($id, $short = false)
    {
        $op = self::find($id);
        return (!$short) ? $op->nama_jenis_op : $op->nama_jenis_op .' ('. $op->shortcode .')';
    }

    public static function getShortcodeObjekPajak($id)
    {
        $nama = null;
        if(!is_null($id)){
            $nama = self::find($id)->shortcode;
        }

        return $nama;
    }
    
    public function is_objekPajak()
    {
        return $this->objekpajak() && !is_null($this->objekpajak);
    }

    public function objekpajak()
    {
        return $this->hasOne(ObjekPajak::class,'id','id_jenis_op');
    }

    public function targetPajak()
    {
        return $this->hasOne(TargetPajak::class,'id_jenis_objek_pajak','id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nama_jenis_op', 'like', $term)
            ->orWhere('no_rekening', 'like', $term);
    }
}
