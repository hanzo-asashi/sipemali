<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

/**
 * @mixin IdeHelperNilaiPajakReklame
 */
class NilaiPajakReklame extends Model
{
    use HasFactory, HasStatuses;

    protected $table = 'nilai_pajak_reklame';
    protected $fillable = ['id_objek_pajak','nilai_pajak','status','metode_bayar'];
}
