<?php

namespace App\Http\Livewire\TransaksiPajak\Tunggakan;

use App\Models\Pembayaran;
use App\Models\Tunggakan;
use App\Utilities\Helper;
use Carbon\Carbon;
use Livewire\Component;

class TunggakanTable extends Component
{
    public string $defaultSort = 'id';
    public int $perPage = 10;
    public string $search = '';
    public array $checked = [];

    protected $listTunggakan;
    protected $tunggakan;
    protected $pembayaran;

    public $pembayaran_id;
    public $no_transaksi;
    public $tgl_bayar;
    public $tgl_jatuh_tempo;
    public $lama_tunggakan;
    public $status_tunggakan;
    public $jumlah_tagihan;
    public $jumlah_bayar;
    public $denda;
    public $sisa_bayar;
    public $tagihan_ke;
    public $total_tagihan;

    public string $selectedJenisOp = '';
    public bool $showModalTunggakan;

    public function mount(Tunggakan $tunggakan)
    {
        $this->tunggakan = $tunggakan;
        $this->pembayaran = $this->tunggakan->with('pembayaran')->get();
    }

    public function checkJatuhTempo()
    {
        $pembayaran = Pembayaran::where('tahun', setting('tahun_sppt'))
            ->where('status_bayar', 0)
            ->where('jumlah_bayar', 0)
            ->whereDate('jatuh_tempo', '<', now())
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->orderByDesc('jatuh_tempo')
            ->get();

        if (!is_null($pembayaran)) {
            foreach ($pembayaran as $bayar) {
                $lamaTunggakan = Carbon::now()->diffInDays($bayar->jatuh_tempo,false);

                if($lamaTunggakan < 0){
                    $values = [
                        'pembayaran_id'    => $bayar->id,
                        'tgl_bayar'        => $bayar->tgl_bayar,
                        'tgl_jatuh_tempo'  => $bayar->jatuh_tempo,
                        'lama_tunggakan'   => Carbon::now()->diffInDays($bayar->jatuh_tempo),
                        'jumlah_tagihan'   => $bayar->nilai_pajak,
                        'jumlah_bayar'     => $bayar->jumlah_bayar,
                        'denda'            => (($bayar->nilai_pajak * (int) setting('persen_denda_default')) / 100) * Carbon::now()->diffInDays($bayar->jatuh_tempo),
                        'sisa_bayar'       => $bayar->sisa,
                        'total_tagihan'    => $bayar->nilai_pajak + $bayar->denda,
                        'tagihan_ke'       => 1,
                        'status_tunggakan' => 1,
                    ];

//                    if ($bayar->status_transaksi === 2) {
//                        $tunggakan = Tunggakan::where('pembayaran_id', $bayar->id)->first();
//                        $updateValues = [
//                            'lama_tunggakan' => $lamaTunggakan,
//                            'jumlah_tagihan' => $bayar->nilai_pajak,
//                            'denda'          => $tunggakan->denda + (($bayar->nilai_pajak * setting('persen_denda_default')) / 100) * $lamaTunggakan,
//                        ];
//                        $tunggakan->update($updateValues);
//                    }

                    $createTunggakan = Tunggakan::updateOrCreate([
                        'pembayaran_id' => $bayar->id,
                    ], $values);

                    if ($createTunggakan) {
                        $updateBayar = Pembayaran::find($createTunggakan->pembayaran_id);
                        $updateBayar->update([
                            'status_transaksi' => 2,
                        ]);
                    }
                }
            }
        }
    }

    private function closeModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('closeModalTunggakan', $options);
    }

    private function openModal($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('openModalTunggakan', $options);
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function prosesTunggakan()
    {
        $pembayaran = Pembayaran::where('status_transaksi', '<>', 1)->find($this->pembayaran_id);
        if (!is_null($pembayaran)) {

            $pembayaran->update([
                'nilai_pajak'      => $this->total_tagihan,
                'jumlah_bayar'     => $this->jumlah_bayar,
                'denda'            => $this->denda,
                'sisa'             => $this->sisa_bayar,
                'tgl_bayar'        => now(),
                'status_transaksi' => 1,
                'status_bayar'     => 1,
            ]);

            $tunggakan = Tunggakan::where('pembayaran_id', $pembayaran->id ?: $this->pembayaran_id)->update([
                'status_tunggakan' => 0,
                'lama_tunggakan'   => 0,
                'denda'            => 0,
                'jumlah_tagihan'   => $this->jumlah_tagihan,
                'sisa_bayar'       => $this->total_tagihan - $this->jumlah_bayar,
                'jumlah_bayar'     => $this->jumlah_bayar,
                'total_tagihan'    => $this->total_tagihan,
                'tgl_bayar'        => $this->tgl_bayar,
                'tgl_jatuh_tempo'  => null,
            ]);

            if ($tunggakan) {
                $this->alert([
                    'success' => true,
                    'message' => 'Pembayaran tunggakan berhasil ',
                ]);
            } else {
                $this->alert([
                    'success' => false,
                    'message' => 'Pembayaran tunggakan gagal ',
                ]);
            }
            $this->closeModal();
            $this->resetInput();
        }
    }

    private function resetInput()
    {
        $this->reset('jumlah_bayar', 'jumlah_tagihan', 'total_tagihan',
            'denda', 'sisa_bayar'
        );
    }

    public function bayarTunggakan(Tunggakan $tunggakanId)
    {
        $this->showModalTunggakan = true;
        $tunggakan = Tunggakan::with('pembayaran')->find($tunggakanId)->first();

        $this->pembayaran_id = $tunggakan->pembayaran_id;
        $this->no_transaksi = $tunggakan->pembayaran()->get()->first()->no_transaksi;
        $this->tgl_bayar = $tunggakan->tgl_bayar;
        $this->tgl_jatuh_tempo = $tunggakan->tgl_jatuh_tempo;
        $this->lama_tunggakan = $tunggakan->lama_tunggakan;
        $this->jumlah_tagihan = $tunggakan->jumlah_tagihan;
        $this->jumlah_bayar = $tunggakan->jumlah_bayar;
        $this->denda = $tunggakan->denda;
        $this->sisa_bayar = $tunggakan->sisa_bayar;
        $this->tagihan_ke = $tunggakan->tagihan_ke;
        $this->total_tagihan = $tunggakan->jumlah_tagihan + $tunggakan->denda ?: $tunggakan->total_tagihan;
        $this->openModal(['tunggakan' => $this->tunggakan]);
    }

    public function render()
    {
//        dd($this->objekpajak);
//        $this->listObjekPajak = $this->objekpajak->with(['wajibpajak', 'pembayaran','jenisObjekPajak'])
//            ->search(trim($this->search))
//            ->when($this->selectedJenisOp, function ($q) {
//                $q->where('id_jenis_op', $this->selectedJenisOp);
//            })
//            ->whereHas('pembayaran', function ($q){
//                $q->where('status_bayar', 1)
//                    ->where('status_transaksi', 2);
//            })
//            ->orderBy($this->defaultSort)
//            ->paginate($this->perPage);

        $listTunggakan = Tunggakan::with('pembayaran')
            ->search(trim($this->search))
            ->when($this->selectedJenisOp, function ($q) {
                $q->whereHas('pembayaran', function ($q) {
                    $q->where('objek_pajak_id', $this->selectedJenisOp);
                });
            })
            ->paginate($this->perPage);

//        $listJenisOp = JenisObjekPajak::pluck('nama_jenis_op', 'id');
//        $listMetodeBayar = MetodeBayar::pluck('jenis_metode', 'id');
//        $listBulan = config('custom.bulan');

        return view('livewire.transaksi-pajak.tunggakan.tunggakan-table', compact('listTunggakan'));
    }
}
