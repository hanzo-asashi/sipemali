<?php

namespace App\Http\Livewire\ObjekPajak;

use App\Models\BahanBakuTambang;
use App\Models\DaftarOpd;
use App\Models\JenisReklame;
use App\Models\ObjekPajak;
use App\Models\ObjekPajakTambangMineral;
use App\Models\Pembayaran;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;

class CreateForm extends Component
{
    public $objekPajak;
    public $wajibPajak;
    public $jenisReklame, $tipeUsaha, $kategoriReklame, $shortcode;
    public $selectedJenisOp;
    public $selectedOp = null;
    public int $totalOp;
    public $objekpajakid;

    public $id_wp;
    public $id_jenis_op;
    public $nopd;
    public $nama_objek_pajak;
    public $kabupaten;
    public $kecamatan;
    public $kelurahan;
    public $alamat;
    public $keterangan;
    public $nomor_skpd;

    public $detailObjekPajak;
    public $izin;
    public bool $updateMode = false;
    public $editObjekPajak;

    public $listKabupaten, $listKecamatan, $listKelurahan;
    public $selectedProvinsi;
    public string $success = '';
    public bool $showSatuan = false;

    public $id_kategori = null,
        $id_jenis_usaha = null,
        $id_jenis_reklame = null,
        $panjang = 0,
        $lebar = 0,
        $tipeSatuan = null,
        $kuantiti = 0;

    public $tanggal_setoran,
        $nama_wajib_pajak,
        $jenis_pekerjaan,
        $opd_penanggungjawab_anggaran,
        $no_kontrak,
        $bahan_baku,
        $tahun_berdasarkan_kontrak,
        $nilai_kontrak,
        $status,
        $objek_pajak_id;

    public $nama_wilayah;
    public $triwulan;
    public $besaran_kwh;
    public $nilai_pajak;
    public $tahun_pajak_ppj;
    public $periode;

    public $bahanBakuTambang = [];
    public $allBahanBaku;
    public $jenisBahanBaku = [''];
    public $id_jenis_bahan_baku;
    public $volume;
    public $satuan;
    public $saved = false;

    public $nomor_sts = null;
    public $jatuh_tempo = null;
    public $jumlah_bayar = 0;
    public $denda = 0;
    public $sisa = '0';
    public $status_bayar = 0;
    public $status_transaksi = 1;

    public array $data = [];
    public bool $sukses = false;
    public string $message = '';
    public $tglJatuhTempo;

    protected $model;

    protected $listeners = [];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addBahanBakuTambang()
    {
        $this->bahanBakuTambang[] = [
            'id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => '',
        ];
    }

    public function removeBahanBakuTambang($index, $value)
    {
        if (!is_null($value)) {
            $objekPajak = ObjekPajak::find($this->editObjekPajak);
            $objekPajakTambang = ObjekPajakTambangMineral::where('objek_pajak_id', $objekPajak->id)->first();
            $bahanBakuTambang = BahanBakuTambang::where('id_jenis_bahan_baku', $value)->where('id_objek_pajak', $objekPajakTambang->id)->first()->delete();
            if ($bahanBakuTambang) {
                unset($this->bahanBakuTambang[$index]);
                $this->bahanBakuTambang = array_values($this->bahanBakuTambang);
            }
        }

        unset($this->bahanBakuTambang[$index]);
        $this->bahanBakuTambang = array_values($this->bahanBakuTambang);
    }

    public function updatedBahanBakuTambang($key, $value)
    {
        $parts = explode('.', $value);
        if (count($parts) == 2 && $parts[1] === 'id_jenis_bahan_baku') {
            $jenisBahanBaku = $this->allBahanBaku->where('id', $key)->first();
            if (!is_null($jenisBahanBaku)) {
                $this->bahanBakuTambang[$parts[0]][$parts[1]] = $jenisBahanBaku->id;
                $this->bahanBakuTambang[$parts[0]]['satuan'] = $jenisBahanBaku->satuan;
            }
        }
    }

    private function _getModel($model)
    {
        return Helper::getModelInstance($model);
    }

    public function mount(ObjekPajak $objekPajak)
    {
        if (request()->has('wajib_pajak_id')) {
            $this->id_wp = request()->get('wajib_pajak_id');
        }

        $this->objekPajak = $objekPajak;

        $this->allBahanBaku = $this->_getModel('JenisBahanBakuMineral')::all();
//        $this->bahanBakuTambang = [
//            ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => ''],
//            ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => ''],
//            ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => ''],
//        ];

        $this->selectedProvinsi = setting('kode_provinsi');
        $this->kabupaten = setting('kode_kabupaten');
        $this->nama_wilayah = setting('kode_kabupaten');
        $this->listKabupaten = self::getWilayah($this->selectedProvinsi);

        if (!is_null($this->kabupaten)) {
            $this->listKecamatan = self::getWilayah($this->kabupaten);
        } else {
            $this->listKecamatan = collect();
        }

        $this->listKelurahan = collect();

        if (!is_null($this->nama_wilayah)) {
            if ($this->selectedOp == 5) {
                $this->nama_objek_pajak = 'PPJ-'.Helper::getNamaWilayah($this->kabupaten);
            }
        }

        if ($this->updateMode) {
            $opd = $this->objekPajak->find($this->editObjekPajak);
            self::updateField($opd);
        }

        $this->tglJatuhTempo = Carbon::parse($date ?? now())
            ->addDays(Helper::jumlah_hari(now()));
        $this->tahun_pajak_ppj = now()->year ?: setting('tahun_sppt');
    }

    private function updateField($opd)
    {
        $this->selectedOp = $opd->id_jenis_op;
        $this->id_wp = $opd->id_wp;
        $this->id_jenis_op = $opd->id_jenis_op;
        $this->nopd = $opd->nopd;
        $this->nama_objek_pajak = $opd->nama_objek_pajak;
        $this->kabupaten = $opd->kabupaten;
        $this->kecamatan = $opd->kecamatan;
        $this->kelurahan = $opd->kelurahan;
        $this->alamat = $opd->alamat;
        $this->keterangan = $opd->keterangan;
        $this->listKelurahan = self::getWilayah($this->kecamatan);

        if ($this->selectedOp === 1) {
            $obj = $this->_getModel('ObjekPajakRumahMakan')::where('objek_pajak_id', $opd->id)->get()->first();
            $this->izin = $obj->izin;
        } elseif ($this->selectedOp === 2) {
            $obj = $this->_getModel('ObjekPajakHotel')::where('objek_pajak_id', $opd->id)->get()->first();
            $this->izin = $obj->izin;
        } elseif ($this->selectedOp === 3) {
            $obj = $this->_getModel('ObjekPajakReklame')::where('objek_pajak_id', $opd->id)->get()->first();
            $this->objek_pajak_id = $obj->objek_pajak_id;
            $this->id_kategori = $obj->id_kategori;
            $this->id_jenis_usaha = $obj->id_jenis_usaha;
            $this->id_jenis_reklame = $obj->id_jenis_reklame;
            $this->izin = $obj->izin;
            $this->panjang = $obj->panjang;
            $this->lebar = $obj->lebar;
            $this->kuantiti = $obj->kuantiti;

            $jenisReklame = JenisReklame::find($obj->id_jenis_reklame);
            if (!is_null($jenisReklame)) {
                if ($jenisReklame->tipe_satuan !== 2) {
                    $this->showSatuan = true;
                } else {
                    $this->showSatuan = false;
                }
            } else {
                $this->showSatuan = false;
            }

        } elseif ($this->selectedOp === 4) {
            $obj = $this->_getModel('ObjekPajakTambangMineral')::with('bahanbaku')->where('objek_pajak_id', $opd->id)->get()->first();
            $this->tanggal_setoran = $obj->tanggal_setoran;
            $this->nama_wajib_pajak = $obj->nama_wajib_pajak;
            $this->jenis_pekerjaan = $obj->jenis_pekerjaan;
            $this->opd_penanggungjawab_anggaran = $obj->opd_penanggungjawab_anggaran;
            $this->no_kontrak = $obj->no_kontrak;
            $this->tahun_berdasarkan_kontrak = $obj->tahun_berdasarkan_kontrak;
            $this->nilai_kontrak = $obj->nilai_kontrak;
            $this->status = $obj->status;
            $this->keterangan = $obj->keterangan;

            $bahanbaku = [];
            foreach ($obj->bahanbaku()->get() as $item) {
                $bahanbaku[] = [
                    'id_jenis_bahan_baku' => $item->id_jenis_bahan_baku,
                    'jumlah_volume'       => $item->jumlah_volume,
                    'satuan'              => $item->satuan,
                ];
            }

            $this->bahanBakuTambang = $bahanbaku;

        } elseif ($this->selectedOp === 5) {
            $obj = $this->_getModel('ObjekPajakPeneranganJalanUmum')::where('objek_pajak_id', $opd->id)->get()->first();
            $this->nama_wilayah = $obj->nama_wilayah;
            $this->besaran_kwh = $obj->besaran_kwh;
            $this->nilai_pajak = $obj->nilai_pajak;
            $this->triwulan = $obj->triwulan;
            $this->tahun_pajak_ppj = $obj->tahun_pajak_ppj;
        }
    }

    private function getWilayah($kode)
    {
        return Helper::getWilayah($kode);
    }

    private function insertOrUpdateObjekPajak($model, array $data, $id = '')
    {
        $model = Helper::getModelInstance($model);
        if ($this->updateMode) {
            return $model::where('objek_pajak_id', $id ?: $this->editObjekPajak)->get()->first();
        } else {
            return $model::create($data);
        }
    }

    private function insertOpRumahMakan($op)
    {
        $objekPajakRm = $this->insertOrUpdateObjekPajak('ObjekPajakRumahMakan', [
            'objek_pajak_id' => $op->id,
            'izin'           => $this->izin,
        ]);

        if ($objekPajakRm) {
            $this->_dataPembayaran($op);
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    private function insertOpHotel($op)
    {
        $objekPajakHotel = $this->insertOrUpdateObjekPajak('ObjekPajakHotel', [
            'objek_pajak_id' => $op->id,
            'izin'           => $this->izin,
        ]);

        if ($objekPajakHotel) {
            $this->_dataPembayaran($op);
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    private function insertOpReklame($op)
    {
        $objekPajakReklame = $this->insertOrUpdateObjekPajak('ObjekPajakReklame', [
            'id_kategori'      => $this->id_kategori,
            'objek_pajak_id'   => $op->id,
            'id_jenis_usaha'   => $this->id_jenis_usaha,
            'id_jenis_reklame' => $this->id_jenis_reklame,
            'izin'             => $this->izin,
            'panjang'          => $this->panjang,
            'lebar'            => $this->lebar,
            'kuantiti'         => $this->kuantiti,
        ]);

        if ($objekPajakReklame) {
            $jenisReklame = $this->_getModel('JenisReklame')::with(['tarif', 'satuan'])
                ->find($this->id_jenis_reklame);
            if (!is_null($jenisReklame)) {
                $nilaiStrategis = $jenisReklame->nilai_strategis;
                $jenisTarif = $jenisReklame->jenis_tarif;
                $njopr = $jenisReklame->nilai_jual_objek_pajak;
                $periode = $jenisReklame->periode_pembayaran;

                $nilaiPajak = 0;
                if (isset($this->panjang) && isset($this->lebar)) {
                    $ns = Helper::hitungPajakReklame($jenisTarif,$nilaiStrategis, $njopr);
                    $nilaiPajak = Helper::hitungPajakBillboard($ns,$this->panjang, $this->lebar);
                }

                if (isset($this->kuantiti) && $this->kuantiti > 0) {
                    $ns = Helper::hitungPajakReklame($jenisTarif, $nilaiStrategis, $njopr);
                    $nilaiPajak = Helper::hitungPajakKuantiti($ns, $this->kuantiti);
                }

                if ($nilaiPajak > 0) {
                    if ($periode === 1) {
                        $tglJatuhTempo = Carbon::parse(now())->addDays(1);
                    } elseif ($periode === 2) {
                        $tglJatuhTempo = Carbon::parse(now())->addDays(7);
                    } else {
                        $tglJatuhTempo = Carbon::parse(now())->addDays(365);
                    }
                } else {
                    $tglJatuhTempo = null;
                }

                $data = [
                    'wajib_pajak_id'   => $op->id_wp,
                    'objek_pajak_id'   => $op->id,
                    'nilai_pajak'      => $nilaiPajak,
                    'metode_bayar'     => 1,
                    'no_transaksi'     => Helper::generateNoTransaksi(),
                    'jumlah_bayar'     => 0,
                    'bulan'            => setting('masa_pajak_bulan'),
                    'tahun'            => setting('tahun_sppt'),
                    'nomor_sts'        => $nilaiPajak > 0 ? Helper::generateNomorSts($op->id_jenis_op, $op->id) : '',
                    'nomor_skpd'       => $nilaiPajak > 0 ? Helper::generateNomorSkpd($op->id_jenis_op, $op->id, setting('masa_pajak_bulan'), setting('tahun_sppt')) : '',
                    'jatuh_tempo'      => $tglJatuhTempo,
                    'status_bayar'     => 0,
                    'status_transaksi' => 1,
                    // 1 => Berhasil, 2 => Menunggak, 3 => Jatuh Tempo
                    'keterangan'       => '',
                ];

                self::insertPembayaran($data);
            }
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    private function insertOpTambang($op)
    {
        $objekPajakTambang = $this->insertOrUpdateObjekPajak('ObjekPajakTambangMineral', [
            'objek_pajak_id'               => $op->id,
            'tanggal_setoran'              => $this->tanggal_setoran,
            'nama_wajib_pajak'             => 'N/A',
            'jenis_pekerjaan'              => $this->jenis_pekerjaan,
            'opd_penanggungjawab_anggaran' => $this->opd_penanggungjawab_anggaran,
            'no_kontrak'                   => $this->no_kontrak,
            'tahun_berdasarkan_kontrak'    => $this->tahun_berdasarkan_kontrak,
            'nilai_kontrak'                => $this->nilai_kontrak,
            'status'                       => $this->status,
            'kabupaten'                    => $this->kabupaten ?: '-',
            'kecamatan'                    => $this->kecamatan ?: '-',
            'kelurahan'                    => $this->kelurahan ?: '-',
            'keterangan'                   => $this->keterangan ?: null,
        ]);

        if ($objekPajakTambang) {
            $nilai = [];

            foreach ($this->bahanBakuTambang as $item) {
                BahanBakuTambang::where('id_objek_pajak', $objekPajakTambang->id)->updateOrCreate($item + [
                    'id_objek_pajak' => $objekPajakTambang->id
                ], $item + ['id_objek_pajak' => $objekPajakTambang->id]);

                $jenisBahanBaku = $this->_getModel('JenisBahanBakuMineral')::find($item['id_jenis_bahan_baku']);
                $nilaiBahanBaku = $jenisBahanBaku->nilai;
                $nilai[] = ($nilaiBahanBaku * $item['jumlah_volume'] * setting('persen_pajak_mineral')) / 100;

            }

            $nilaiPajak = (double) array_sum($nilai) ?: 0;
            $tglJatuhTempo = $nilaiPajak > 0 ? Carbon::parse($this->tanggal_setoran ?? now())->addDays(Helper::jumlah_hari(now())) : null;
            $data = [
                'wajib_pajak_id'   => $op->id_wp,
                'objek_pajak_id'   => $op->id,
                'metode_bayar'     => 1,
                'no_transaksi'     => Helper::generateNoTransaksi(),
                'jumlah_bayar'     => 0,
                'bulan'            => setting('masa_pajak_bulan'),
                'nilai_pajak'      => $nilaiPajak,
                'tahun'            => setting('tahun_sppt'),
                'nomor_sts'        => $nilaiPajak > 0 ? Helper::generateNomorSts($op->id_jenis_op, $op->id) : '',
                'nomor_skpd'       => $nilaiPajak > 0 ? Helper::generateNomorSkpd($op->id_jenis_op, $op->id, setting('masa_pajak_bulan'), setting('tahun_sppt')) : '',
                'jatuh_tempo'      => $tglJatuhTempo,
                'status_bayar'     => 0,
                'status_transaksi' => 1, // 1 => Lancar, 2 => Menunggak, 3 => Jatuh Tempo
                'keterangan'       => '',
            ];
            self::insertPembayaran($data);
        }

        $this->clearObjekPajak($this->selectedOp);
    }

    private function insertOpPju($op)
    {
        $objekPju = $this->insertOrUpdateObjekPajak('ObjekPajakPeneranganJalanUmum', [
            'objek_pajak_id' => $op->id,
            'nama_wilayah'   => $this->nama_wilayah,
            //            'triwulan'        => $this->triwulan,
            //            'besaran_kwh'     => $this->besaran_kwh,
            //            'nilai_pajak'     => $this->nilai_pajak,
            //            'tahun_pajak_ppj' => $this->tahun_pajak_ppj,
        ]);

        if ($objekPju) {

            $data = [
                'wajib_pajak_id' => $op->id_wp,
                'objek_pajak_id' => $op->id,
                'metode_bayar'   => 1,
                'no_transaksi'   => Helper::generateNoTransaksi(),
                'jumlah_bayar'   => 0,
                'bulan'          => setting('masa_pajak_bulan', now()->month),
                'nilai_pajak'    => 0,
                'tahun'          => setting('tahun_sppt', now()->year),
                //                'nomor_sts'        => $nilaiPajak > 0 ? Helper::generateNomorSts($op->id_jenis_op) : null,
                //                'jatuh_tempo'      => $tglJatuhTempo,
                //                'status_bayar'     => 0,
                //                'status_transaksi' => 1,
                // 1 => Selesai, 2 => Menunggak, 3 => Jatuh Tempo
                'keterangan'     => '',
            ];
            self::insertPembayaran($data);
        }

        $this->clearObjekPajak($this->selectedOp);
    }

    private function insertPembayaran($data, $id = null)
    {
        if ($this->updateMode && !is_null($id)) {
            $pembayaran = Pembayaran::find($id);
        } else {
            $pembayaran = Pembayaran::create($data);
        }

        return $pembayaran;
    }

    public function submit()
    {
        $this->data = ['success' => false, 'message' => ''];

        $validatedData = $this->validate([
                'id_wp'            => 'required',
                'id_jenis_op'      => 'required',
                'nopd'             => 'exclude_if:id_jenis_op,4|unique:objek_pajak,nopd',
                'nama_objek_pajak' => 'max:255',
                'kabupaten'        => '',
                'kecamatan'        => '',
                'kelurahan'        => '',
                'alamat'           => 'max:255',
                'keterangan'       => 'nullable',
            ] + $this->validationRuleOp($this->selectedOp), [], [
                'id_jenis_op' => 'jenis objek pajak',
                'id_wp'       => 'wajib pajak',
            ]
        );

//        $validatedData['nopd'] = $validatedData['nopd'] ?: "-";
        $validatedData['nomor_skpd'] = Helper::generateNomorSkpdOp($this->selectedOp);
        $validatedData['nomor_sts'] = Helper::generateNomorStsOp($this->selectedOp);
        $validatedData['nama_objek_pajak'] = $validatedData['nama_objek_pajak'] ?: "-";
        $validatedData['keterangan'] = $validatedData['keterangan'] ?: "-";

        $op = $this->insertOrUpdateObjekPajak('ObjekPajak', $validatedData);
        $this->objekpajakid = ['wajibpajakid' => $op->id_wp, 'objekpajakid' => $op->id];

        if ($op) {
            // Simpan Data Objek Pajak Berdasarkan Jenis Objek Pajak
            if ($this->selectedOp === 1) {
                self::insertOpRumahMakan($op);
            } elseif ($this->selectedOp === 2) {
                self::insertOpHotel($op);
                $this->clearObjekPajak($this->selectedOp);
            } elseif ($this->selectedOp === 3) {
                self::insertOpReklame($op);
            } elseif ($this->selectedOp === 4) {
                self::insertOpTambang($op);
            } elseif ($this->selectedOp === 5) {
                self::insertOpPju($op);
            }
            $this->alert([
                'success' => true,
                'message' => 'Objek pajak berhasil ditambahkan',
            ]);
        } else {
            $this->alert([
                'success' => false,
                'message' => 'Objek pajak gagal ditambahkan',
            ]);
        }
        $this->clearForm();
        $this->dispatchBrowserEvent('clearSelect', ['wpid' => $this->id_wp]);
        $this->resetValidation();
    }

    public function submitAndBayar()
    {
        $this->submit();
        $this->redirectRoute('pembayaran.tambah', $this->objekpajakid);
    }

    public function updatedIdWp($val)
    {
        if (is_array($val)) {
            $this->id_wp = $val['value'];
        } else {
            $this->id_wp = (int) $val;
        }
    }

    public function updatedJenisPekerjaan($value)
    {
        $this->nama_objek_pajak = $value;
    }

    private function updateOpRumahMakan($op)
    {
        $validatedData = $this->validate($this->validationRuleOp($this->selectedOp));
        $objekPajakRm = $this->insertOrUpdateObjekPajak('ObjekPajakRumahMakan', $validatedData, $this->editObjekPajak);
        if ($objekPajakRm->update($validatedData)) {
            $op->update($validatedData);
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    private function updateOpHotel($op)
    {
        $validatedData = $this->validate($this->validationRuleOp($this->selectedOp));
        $objekPajakHotel = $this->insertOrUpdateObjekPajak('ObjekPajakHotel', $validatedData, $this->editObjekPajak);
        if ($objekPajakHotel->update($validatedData)) {
            $op->update($validatedData);
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    private function updateOpReklame($op)
    {
        $validatedData = $this->validate($this->validationRuleOp($this->selectedOp));
        $jenisReklame = $this->_getModel('JenisReklame')->find($this->id_jenis_reklame);

        if (!is_null($jenisReklame)) {
            $nilaiStrategis = $jenisReklame->nilai_strategis;
            $jenisTarif = $jenisReklame->jenis_tarif;
            $njopr = $jenisReklame->nilai_jual_objek_pajak;
            $periode = $jenisReklame->periode_pembayaran;

            $nilaiPajak = 0;
            if (isset($this->panjang) && isset($this->lebar)) {
                $pr = Helper::hitungPajakReklame($jenisTarif,
                    $nilaiStrategis, $njopr
                );
                $nilaiPajak = Helper::hitungPajakBillboard($pr,
                    $this->panjang, $this->lebar
                );
            }

            if (isset($this->kuantiti) && $this->kuantiti > 0) {
                $pr = Helper::hitungPajakReklame($jenisTarif,
                    $nilaiStrategis, $njopr
                );
                $nilaiPajak = Helper::hitungPajakKuantiti($pr,
                    $this->kuantiti
                );
            }
        }

        $objekPajakReklame = $this->insertOrUpdateObjekPajak('ObjekPajakReklame', $validatedData, $this->editObjekPajak);
        $pembayaran = Pembayaran::where('wajib_pajak_id', $op->id_wp)
            ->where('objek_pajak_id', $op->id)->get()->first();

        if ($pembayaran->update(['nilai_pajak' => $nilaiPajak])) {
            $objekPajakReklame->update($validatedData);
            $op->update($validatedData);
        }

        $this->clearObjekPajak($this->selectedOp);
    }

    private function updateOpTambang($op)
    {
        $validatedData = $this->validate($this->validationRuleOp($this->selectedOp));
        $objekPajakTambang = $this->insertOrUpdateObjekPajak('ObjekPajakTambangMineral', $validatedData, $this->editObjekPajak);
        $nilai = [];
        foreach ($this->bahanBakuTambang as $item) {
            $values = [
                'id_objek_pajak'      => $objekPajakTambang->id,
                'id_jenis_bahan_baku' => $item['id_jenis_bahan_baku'],
                'jumlah_volume'       => $item['jumlah_volume'],
                'satuan'              => $item['satuan'] ?? 'm3',
            ];

            BahanBakuTambang::where('id_objek_pajak', $objekPajakTambang->id)->updateOrInsert([
                'id_objek_pajak'      => $objekPajakTambang->id,
                'id_jenis_bahan_baku' => $item['id_jenis_bahan_baku'],
            ], $values);

            $jenisBahanBaku = $this->_getModel('JenisBahanBakuMineral')::find($item['id_jenis_bahan_baku']);
            $nilaiBahanBaku = $jenisBahanBaku->nilai;
            $nilai[] = ($nilaiBahanBaku * $item['jumlah_volume'] * setting('persen_pajak_mineral')) / 100;
        }
//        $totalNilai = (double) array_sum($nilai) ?: 0;
//        $totalNilai = (double) $objekPajakTambang->nilai_kontrak + (double) $totalNilai;
//        $nilaiPajak = $totalNilai > 0 ? ($totalNilai * 10) / 100 : 0;
        $nilaiPajak = (double) array_sum($nilai) ?: 0;

        $pembayaran = Pembayaran::where('wajib_pajak_id', $op->id_wp)
            ->where('objek_pajak_id', $op->id)->get()->first()
            ->update(['nilai_pajak' => $nilaiPajak]);

        if ($pembayaran) {
            $objekPajakTambang->update($validatedData);
            $op->update($validatedData);
            $this->alert([
                'success' => true,
                'message' => 'Objek Pajak PPJ Berhasil diperbaharui',
            ]);
        }

        $this->clearObjekPajak($this->selectedOp);
    }

    private function updateOpPju($op)
    {
        $validatedData = $this->validate($this->validationRuleOp($this->selectedOp));
        $objekPajakPju = $this->insertOrUpdateObjekPajak('ObjekPajakPeneranganJalanUmum', $validatedData, $this->editObjekPajak)->update($validatedData);

        if ($objekPajakPju) {
            $op->update($validatedData);
            $this->alert([
                'success' => true,
                'message' => 'Objek Pajak PPJ Berhasil diperbaharui',
            ]);
//            $nilaiPajak = $this->besaran_kwh * $this->nilai_pajak;
//            $pembayaran = Pembayaran::where('wajib_pajak_id', $op->id_wp)
//                ->where('objek_pajak_id', $op->id)->get()->first()
//                ->update(['nilai_pajak' => $nilaiPajak]);

//            if ($pembayaran) {
//                $objekPajakPju->update($validatedData);
//                $op->update($validatedData);
//            }
        } else {
            $this->alert([
                'success' => false,
                'message' => 'Objek Pajak PPJ gagal diperbaharui',
            ]);
        }
        $this->clearObjekPajak($this->selectedOp);
    }

    public function updateObjPajak()
    {
        $this->data = [
            'success' => false, 'message' => 'Objek Pajak gagal di perbaharui',
        ];

        $validatedData = $this->validate([
                'id_wp'            => 'required',
                'id_jenis_op'      => 'required',
                'nopd'             => 'required',
                'nama_objek_pajak' => 'max:255',
                'kabupaten'        => 'required',
                'kecamatan'        => 'required',
                'kelurahan'        => 'required',
                'alamat'           => 'max:255',
                'keterangan'       => 'max:255',
            ] + $this->validationRuleOp($this->selectedOp), [], [
                'id_jenis_op' => 'jenis objek pajak',
                'id_wp'       => 'wajib pajak',
            ]
        );

        $validatedData['nopd'] = $validatedData['nopd'] ?? '-';
        $validatedData['nama_objek_pajak'] = $validatedData['nama_objek_pajak'] ?? '-';
        $validatedData['keterangan'] = $validatedData['keterangan'] ?? '-';

        $op = $this->_getModel('ObjekPajak')->find($this->editObjekPajak);

        if ($op) {
            // update Data Objek Pajak Berdasarkan Jenis Objek Pajak
            if ($this->selectedOp === 1) {
                self::updateOpRumahMakan($op);
            } elseif ($this->selectedOp === 2) {
                self::updateOpHotel($op);
            } elseif ($this->selectedOp === 3) {
                self::updateOpReklame($op);
            } elseif ($this->selectedOp === 4) {
                self::updateOpTambang($op);
            } elseif ($this->selectedOp === 5) {
                self::updateOpPju($op);
            }

            $op->update($validatedData);
            $this->dispatchBrowserEvent('alert', [
                'success' => true,
                'message' => 'Objek pajak berhasil diperbaharui',
            ]);
            $this->redirectRoute('objek-pajak.index');
        } else {
            $this->dispatchBrowserEvent('alert', [
                'success' => false,
                'message' => 'Objek pajak gagal diperbaharui',
            ]);
        }

        $this->clearForm();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    private function validationRuleOp($id): array
    {
        if ($id === 1 || $id === 2) {
            $rule = ['izin' => 'required'];
        } elseif ($id === 3) {
            $rule = [
                'id_kategori'      => 'required',
                'id_jenis_usaha'   => 'required',
                'id_jenis_reklame' => 'required',
                'izin'             => 'required',
                'panjang'          => 'required',
                'lebar'            => 'required',
                'kuantiti'         => 'required',
            ];
        } elseif ($id === 4) {
            $rule = [
                'tanggal_setoran'              => 'required',
                'jenis_pekerjaan'              => 'required',
                'opd_penanggungjawab_anggaran' => 'required',
                'no_kontrak'                   => 'required',
                'tahun_berdasarkan_kontrak'    => 'required',
                'nilai_kontrak'                => 'required',
                'status'                       => 'required',
            ];
        } elseif ($id === 5) {
            $rule = [
                'nama_wilayah' => 'required',
                //                'triwulan'     => 'required',
                //                'besaran_kwh'  => 'required|integer',
                //                'nilai_pajak'  => 'required|integer',
            ];
        } else {
            $rule = [];
        }

        return $rule;
    }

    /**
     * @param $op
     * @param  null  $id
     */
    private function _dataPembayaran($op, $id = null): void
    {
        $data = [
            'wajib_pajak_id'   => $op->id_wp,
            'objek_pajak_id'   => $op->id,
            'metode_bayar'     => 1,
            'no_transaksi'     => Helper::generateNoTransaksi(),
            'jumlah_bayar'     => 0,
            'bulan'            => setting('masa_pajak_bulan'),
            'nilai_pajak'      => 0,
            'tahun'            => setting('tahun_sppt'),
            'nomor_sts'        => '',
            'nomor_skpd'       => '',
            'jatuh_tempo'      => null,
            'status_bayar'     => 0,
            'status_transaksi' => 1,   // 1 => Berhasil, 2 => Menunggak, 3 => Jatuh Tempo
            'keterangan'       => null,
        ];
        self::insertPembayaran($data, $id);
        $this->clearObjekPajak($this->selectedOp);
    }

    public function clearObjekPajak($id)
    {
        if ($id === 1 || $id === 2) {
            $rule = ['izin'];
        } elseif ($id === 3) {
            $rule = [
                'id_kategori',
                'id_jenis_usaha',
                'id_jenis_reklame',
                'izin',
                'panjang',
                'lebar',
                'kuantiti',
            ];
        } elseif ($id === 4) {
            $rule = [
                'tanggal_setoran',
                'nama_wajib_pajak',
                'jenis_pekerjaan',
                'opd_penanggungjawab_anggaran',
                'no_kontrak',
                'tahun_berdasarkan_kontrak',
                'nilai_kontrak',
                'status',
            ];
        } elseif ($id === 5) {
            $rule = [
                'nama_wilayah',
                'triwulan',
                'besaran_kwh',
                'nilai_pajak',
            ];
        } else {
            $rule = [];
        }

        $this->reset($rule);
    }

    private function alert($options = false)
    {
        $options = ($options && is_array($options)) ? $options : [];
        $this->dispatchBrowserEvent('alert', $options);
    }

    public function clearForm()
    {
        $this->reset([
            'id_jenis_op',
            'id_wp',
            'nama_objek_pajak',
            'nopd',
            'kecamatan',
            'kelurahan',
            'alamat',
            'keterangan',
        ]);
    }

    public function updatedIdJenisOp($id)
    {
        $this->selectedOp = (int) $id;
        if($this->selectedOp === 4){
            $this->bahanBakuTambang = [
                ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => 'm3'],
                ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => 'm3'],
                ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => 'm3'],
                ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => 'm3'],
                ['id_jenis_bahan_baku' => '', 'jumlah_volume' => 0, 'satuan' => 'm3'],
            ];
        }

        if (!is_null($this->nama_objek_pajak)) {
            $this->reset('nama_objek_pajak');
        }
    }

    public function updatedKabupaten($kabupaten)
    {
        if (!is_null($kabupaten)) {
            $this->listKecamatan = self::getWilayah($kabupaten);
        }

        $this->kabupaten = $kabupaten;
    }

    public function updatedKecamatan($kecamatan)
    {
        if (!is_null($kecamatan)) {
            $this->listKelurahan = self::getWilayah($kecamatan);
        }
        $this->kecamatan = $kecamatan;
    }

    public function updatedIdJenisReklame($id)
    {
        $id = (int) $id;
        $jenisReklame = JenisReklame::find($id);
        if (!is_null($jenisReklame)) {
            if ($jenisReklame->tipe_satuan === 2) {
                $this->showSatuan = true;
            } else {
                $this->showSatuan = false;
            }
        } else {
            $this->showSatuan = false;
        }

        $this->jenisReklame = $jenisReklame;
    }

    public function updatedNamaWilayah($kabupaten)
    {
        if (!is_null($kabupaten) && $kabupaten != 'Pilih Wilayah') {
            $this->nama_objek_pajak = 'PPJ-'.Helper::getNamaWilayah($kabupaten);
        }
    }


    public function render()
    {
        $listJenisOp = $this->_getModel('JenisObjekPajak')::pluck('nama_jenis_op', 'id');
        $listWajibPajak = $this->_getModel('WajibPajak')::pluck('nama_wp', 'id');
        $listWajibPajakArr = $this->_getModel('WajibPajak')::all()->toArray();

        $listKategori = $this->_getModel('KategoriReklame')::pluck('nama_kategori', 'id');
        $listTipeUsaha = $this->_getModel('TipeUsahaReklame')::pluck('nama_tipe_usaha', 'id');
        $listJenisReklame = $this->_getModel('JenisReklame')::pluck('nama_jenis_op', 'id');
        $listBahanBaku = $this->_getModel('JenisBahanBakuMineral')::pluck('nama', 'id');

        $listOpd = DaftarOpd::pluck('nama_opd', 'id');
        $listTahun = config('custom.tahun_kontrak');
        $statusBayar = config('custom.status_bayar');
        $statusObj = config('custom.status_obj');

        return view('livewire.objek-pajak.create-form', compact(
                'listJenisOp',
                'listWajibPajak',
                'listWajibPajakArr',
                'listTipeUsaha',
                'listJenisReklame',
                'listKategori',
                'listBahanBaku',
                'listOpd',
                'listTahun',
                'statusBayar',
                'statusObj',
            )
        );
    }
}
