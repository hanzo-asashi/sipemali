<div class="d-flex flex-wrap align-items-center justify-content-end gap-1">
    {{--    <div>--}}
    {{--        <a href="{{ route('laporan.export-excel', ['page' => $page, 'periode' => $periode]) }}" target="_blank" class="btn btn-soft-primary btn-lg mt-1">--}}
    {{--            <i class="mdi mdi-file-excel"></i>--}}
    {{--        </a>--}}
    {{--    </div>--}}
    <div>
        <a href="{{ route('cetak.preview', ['page' => $page, 'periode' => $periode, 'pelanggan' => $pelanggan, 'pembayaran' => $pembayaran,'filterZona' => $filterZona]) }}"
           target="_blank" class="btn btn-primary">
            <i class="far fa-print"></i>
        </a>
    </div>
</div>
