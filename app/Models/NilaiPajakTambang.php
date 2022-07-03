<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

/**
 * @mixin IdeHelperNilaiPajakTambang
 */
class NilaiPajakTambang extends Model
{
    use HasFactory, HasStatuses;

    protected $table = 'nilai_pajak_tambang';
    protected $fillable = ['id_objek_pajak','id_bahan_baku','jumlah_tagihan','jumlah_penerimaan','status','metode_bayar'];
}
