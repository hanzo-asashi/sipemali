<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

/**
 * @mixin IdeHelperNilaiPajakRumahMakan
 */
class NilaiPajakRumahMakan extends Model
{
    use HasFactory, HasStatuses;

    protected $table = 'nilai_pajak_rumah_makan';
    protected $fillable = ['id_objek_pajak','bulan_tahun_pajak','nilai_pajak',
        'status','metode_bayar','persentase_nilai_pajak','keterangan'
    ];
}
