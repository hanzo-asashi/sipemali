<div class="d-flex flex-wrap gap-2">
    <a href="{{ route('laporan.bukticetak',['page' => 'skpd', $objekpajak]) }}" target="_blank" class="btn btn-soft-light waves-effect waves-light">
        <i class="bx bx-printer font-size-16 align-middle me-2"></i> SKPD
    </a>
    <a href="{{ route('laporan.bukticetak',['page' => 'sts', $objekpajak]) }}" target="_blank" type="button" class="btn btn-soft-light waves-effect waves-light">
        <i class="bx bx-printer font-size-16 align-middle me-2"></i> STS
    </a>
</div>
