<div id="op-tambangmineral">
    <h4 class="font-size-16 mb-3 text-primary"><i class="bx bx-label"></i> Pajak Tambang Mineral</h4>
    <div class="row">
        <div class="col-lg-3">
            <div class="mb-3">
                <label for="tanggal_setoran" class="form-label">Tanggal Setoran</label>
                <input wire:model.lazy="tanggal_setoran" type="text" class="form-control @error('tanggal_setoran') is-invalid @enderror" id="tanggal_setoran">
                @error('tanggal_setoran')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-9">
            <div class="mb-3">
                <label for="nama_wajib_pajak" class="form-label">Nama Wajib Pajak</label>
                <input wire:model.lazy="nama_wajib_pajak" type="text" class="form-control @error('nama_wajib_pajak') is-invalid @enderror" id="nama_wajib_pajak">
                @error('nama_wajib_pajak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-3">
                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan / Nama pekerjaan tertulis di
                    kontrak</label>
                <input wire:model.lazy="jenis_pekerjaan" type="text" class="form-control @error('jenis_pekerjaan') is-invalid @enderror" id="jenis_pekerjaan">
                @error('jenis_pekerjaan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="opd_penanggungjawab_anggaran" class="form-label">OPD PenanggungJawab Anggaran</label>
                <select wire:model.lazy="opd_penanggungjawab_anggaran" id="opd_penanggungjawab_anggaran"
                        class="form-select @error('opd_penanggungjawab_anggaran') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    @foreach($listOpd as $key => $opd)
                        <option value="{{ $key }}">{{ $opd }}</option>
                    @endforeach
                </select>
                @error('opd_penanggungjawab_anggaran')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="no_kontrak" class="form-label">Nomor Kontrak</label>
                <input wire:model.lazy="no_kontrak" type="text" class="form-control @error('no_kontrak') is-invalid @enderror" id="no_kontrak">
                @error('no_kontrak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <label for="tahun_berdasarkan_kontrak" class="form-label">Tahun berdasarkan Kontrak</label>
                <select wire:model.lazy="tahun_berdasarkan_kontrak" id="tahun_berdasarkan_kontrak"
                        class="form-select @error('tahun_berdasarkan_kontrak') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    @foreach($listTahun as $key => $tahun)
                        <option value="{{ $key }}">{{ $tahun }}</option>
                    @endforeach
                </select>
                @error('tahun_berdasarkan_kontrak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <label for="nilai_kontrak" class="form-label">Nilai Kontrak (Rp)</label>
                <input wire:model.lazy="nilai_kontrak" type="text" class="form-control @error('nilai_kontrak') is-invalid @enderror" id="nilai_kontrak">
                @error('nilai_kontrak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-2">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select wire:model.lazy="status" class="form-select @error('status') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Pilih salah satu</option>
                    @foreach($statusBayar as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
                @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-8">
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea wire:model.lazy="keterangan" id="keterangan" class="form-control  @error('keterangan') is-invalid @enderror"
                          rows="3"></textarea>
                @error('keterangan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
{{--    <hr>--}}
</div>
@push('script')
<script>
    // flatpickr('#tanggal_setoran',{
    //     altInput: true,
    //     altFormat: "F j, Y",
    //     minDate: "today",
    //     maxDate: new Date().fp_incr(14), // 14 days from now
    //     dateFormat: "m-d-Y H:i"
    // });
</script>
@endpush
