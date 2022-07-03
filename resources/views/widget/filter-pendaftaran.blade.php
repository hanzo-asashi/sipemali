<div class="col-md-3">
    <div>
        <label class="form-label" for="search">Pencarian</label>
        @include('widget.search-table')
    </div>
</div>
<div class="col-md-1">
    <div>
        <label class="form-label" for="form-sm-input">Baris</label>
        @include('widget.page')
    </div>
</div>
<div class="col-md-2">
    <div>
        <label class="form-label" for="kecamatan">Kecamatan</label>
        <select wire:model="selectedKecamatan" class="form-select form-select-sm" id="kecamatan">
            <option value="">Semua Kecamatan</option>
            @foreach($kecamatan as $kec)
                <option wire:key="{{ $kec->id }}" value="{{ $kec->kode }}">{{ $kec->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-2">
    <div>
        @can('manage-users')
            @include('widget.bulk-action')
        @endcan
    </div>
</div>
