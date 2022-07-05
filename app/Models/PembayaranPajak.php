<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

/**
 * @mixin IdeHelperPembayaran
 */
class PembayaranPajak extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'pembayaran_pajak';

    public $casts
        = [
            'jatuh_tempo' => 'datetime:Y-m-d',
            'tgl_bayar'   => 'datetime:Y-m-d',
        ];

    protected $fillable
        = [
            'wajib_pajak_id', 'no_transaksi', 'objek_pajak_id', 'nilai_pajak', 'tahun', 'nomor_skpd', 'nomor_sts', 'jatuh_tempo', 'besaran_kwh',
            'triwulan', 'nilai_pajak_sebelumnya', 'status_bayar', 'status_transaksi', 'metode_bayar', 'bulan', 'jumlah_bayar',
            'keterangan', 'sisa', 'denda', 'keterangan', 'tgl_bayar','harga_satuan_kwh'
        ];

    public function wajibpajak()
    {
        return $this->hasOne(WajibPajak::class, 'id', 'wajib_pajak_id');
    }

    public function tunggakan()
    {
        return $this->hasMany(Tunggakan::class, 'id', 'pembayaran_id');
    }

    public function metodebayar()
    {
        return $this->belongsTo(MetodeBayarPajak::class, 'metode_bayar', 'id');
    }

    public function riwayatPembayaran()
    {
        return $this->hasMany(RiwayatPembayaran::class, 'pembayaran_id', 'id');
    }

    public function objekpajak()
    {
        return $this->belongsTo(ObjekPajak::class, 'objek_pajak_id', 'id')->orderByDesc('nama_objek_pajak');
    }

    public function objekpembayaran()
    {
        return $this->belongsToMany(ObjekPembayaran::class, 'objek_pembayaran', 'id', 'pembayaran_id');
    }

    public function scopeStatusBayar($query, $status)
    {
        return $query->where('status_bayar', $status);
    }

    public function scopeStatusTransaksi($query, $status)
    {
        return $query->where('status_transaksi', $status);
    }

    public function scopeStatusTunggakan($query)
    {
        return $query->where('status_transaksi', '<>', 1);
    }

    public function scopeLatestPayment($query, $tahun, $bulan)
    {
        return $query->where('tahun', $tahun)->where('bulan', $bulan)->where('status_bayar', 1)->where('status_transaksi', '<>', 2);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($pembayaran) {
            return RiwayatPembayaran::create([
                'pembayaran_id' => $pembayaran->id,
                'pembayaran_ke' => 1,
                'pembayaran_bulan' => $pembayaran->bulan,
                'jumlah_bayar' => $pembayaran->jumlah_bayar,
                'tanggal_cetak' => now(),
            ]);
        });

        static::updated(function ($pembayaran) {
            return RiwayatPembayaran::create([
                'pembayaran_id' => $pembayaran->id,
                'pembayaran_ke' => 1,
                'pembayaran_bulan' => $pembayaran->bulan,
                'jumlah_bayar' => $pembayaran->jumlah_bayar,
                'tanggal_cetak' => now(),
            ]);
        });
    }

    public function scopeSearch($query, $term)
    {
        $term = "%{$term}%";
        $query->where('nilai_pajak', 'like', $term)
            ->orWhere('tahun', 'like', $term)
            ->orWhere('bulan', 'like', $term)
            ->orWhere('nomor_sts', 'like', $term)
            ->orWhere('jatuh_tempo', 'like', $term)
            ->orWhere('status_bayar', 'like', $term)
            ->orWhere('status_transaksi', 'like', $term)
            ->orWhereHas('wajibpajak', function ($query) use ($term) {
                $query->where('nama_wp', 'like', $term);
            })
            ->orWhereHas('objekpajak', function ($query) use ($term) {
                $query->where('nama_objek_pajak', 'like', $term);
            });
    }
}
