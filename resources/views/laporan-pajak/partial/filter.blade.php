<div class="d-flex flex-wrap align-items-center gap-2">
    <div>
        <label class="form-label mb-0" for="periode">Tahun</label>
        {!! Form::select('tahun', ['' => 'Pilih Tahun'] + $listTahun, $periode, ['class' => 'form-select form-select-sm']) !!}
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 22px;">Filter</button>
    </div>
</div>
