<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperNilaiPajakHotel
 */
class NilaiPajakHotel extends Model
{
    use HasFactory;

    protected $table = 'nilai_pajak_hotel';
    protected $fillable = ['id_objek_pajak','bulan_tahun_pajak','nilai_pajak',
        'status','metode_bayar','persentase_nilai_pajak','keterangan'
    ];
}
