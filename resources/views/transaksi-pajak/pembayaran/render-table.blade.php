<table class="table table-editable table-hover table-nowrap align-middle table-edits font-size-13">
    <thead>
    <tr class="bg-transparent">
        <th>Wajib Pajak</th>
        <th>Tahun</th>
        <th>Masa Pajak</th>
        <th>Nomor STS</th>
        <th>Jatuh Tempo</th>
        <th>Objek Pajak</th>
        <th>Nilai Pajak</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @forelse($listObjekPajak as $op)
        <div wire:key="{{ $objekPajakId.$op->id }}">
            <tr>
                <td>
                    <a id="{{ $op->id }}" href="javascript: void(0);" class="text-dark fw-medium">{{ $op->wajibpajak->nama_wp }}</a><br>
                    <span class="small text-info">{{ $op->wajibpajak->nwpd }}</span>
                </td>
                <td>{{ $op->pembayaran->tahun ?? setting('tahun_sppt') }}</td>
                <td>{{ (!is_null($op->pembayaran)) ? \App\Utilities\Helper::getNamaBulanIndo($op->pembayaran->bulan) : ''  }}</td>
                <td>{{ $op->pembayaran->nomor_sts ?? 'Belum Ada' }}</td>
                <td>{{ (!is_null($op->pembayaran) ? $op->pembayaran->jatuh_tempo->format('d/m/Y') : '-') }}</td>
                <td>{{ $op->jenisObjekPajak->nama_jenis_op }}<br><span class="small text-warning">{{ $op->nopd }}</span></td>
                <td>{{ (!is_null($op->pembayaran)) ? \Akaunting\Money\Money::IDR($op->pembayaran->nilai_pajak,true) : 0 }}</td>
                <td>
                    @if(isset($op->pembayaran->status_bayar) && $op->pembayaran->status_bayar === 'Lunas')
                        <div class="badge badge-soft-success font-size-12">
                            {{ $op->pembayaran->status_bayar ?? "Lunas" }}
                        </div>
                    @else
                        <div class="badge badge-soft-danger font-size-12">
                            {{ $op->pembayaran->status_bayar ?? "Belum Lunas" }}
                        </div>
                    @endif
                </td>
                <td>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="btn-group">
                            <a id="{{ $op->id }}" href="{{ route('pembayaran.show', $op->id) }}" class="btn btn-sm btn-soft-info waves-effect waves-light">
                                <i class="bx bx-detail font-size-11 align-middle" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Pajak"></i>
                            </a>
                            <x-button wire:click.prevent="$emit('triggerDelete',{{ $op->id }},'single')" id="{{ $objekPajakId }}"
                                      class="btn-sm btn-soft-danger waves-effect waves-light" data-bs-toggle="tooltip"
                                      data-bs-placement="top" title="Hapus Data">
                                <i class="bx bx-trash font-size-11 align-middle"></i>
                            </x-button>
                        </div>
                    </div>
                </td>
            </tr>
        </div>
    @empty
        <tr>
            <td colspan="9" class="text-center font-size-14"><strong>Maaf, data tidak ditemukan.</strong></td>
        </tr>
    @endforelse
    </tbody>
</table>
<x-pagination>
    {{ $listObjekPajak->links() }}
</x-pagination>
