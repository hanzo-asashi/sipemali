@if($objekPajakId == 1 || $objekPajakId === 2 || $objekPajakId === 5)
<div>
    <select class="form-select form-select-sm">
        <option selected disabled>Tahun Pajak</option>
        @foreach($tahunPajak as $key => $item)
            <option value="{{ $key }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
@endif
@if($objekPajakId === 3)
    <div>
        <select class="form-select form-select-sm">
            <option selected disabled>Jenis Reklame</option>
            <option value="">Billboard</option>
            <option value="">Spanduk</option>
            <option value="">Selabaran</option>
        </select>
    </div>
@endif
@if($objekPajakId == 1 || $objekPajakId === 2)
    <div>
        <select class="form-select form-select-sm">
            <option selected disabled>Masa Pajak</option>
            @foreach($bulan as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
@endif

@if($objekPajakId === 5)
    <div>
        <select class="form-select form-select-sm">
            <option selected disabled>Masa Pajak</option>
            <option value="">Triwulan 1</option>
            <option value="">Triwulan 2</option>
            <option value="">Triwulan 3</option>
            <option value="">Triwulan 4</option>
        </select>
    </div>
@endif
<div>
    <select class="form-select form-select-sm">
        <option selected disabled>Status bayar</option>
        @foreach($statusBayar as $key => $item)
            <option value="{{ $key }}">{{ $item }}</option>
        @endforeach
    </select>
</div>

