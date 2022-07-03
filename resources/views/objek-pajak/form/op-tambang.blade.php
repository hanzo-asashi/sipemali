<div id="op-tambangmineral" class="bg-soft-light border-light p-4 mb-3" style="border-top: 1px solid; border-bottom: 1px solid; margin: 0 -20px 0 ">
    <h5 class="font-size-14 text-secondary mb-3">
        <i class="mdi mdi-form-dropdown me-1"></i> OP Tambang Mineral
    </h5>
    <div class="row mb-3">
        <div class="col-lg-3">
            <div>
                <label for="tanggal_setoran" class="form-label">Tanggal Setoran</label>
                <x-inputs.date id="tanggal_setoran" wire:model.lazy="tanggal_setoran"/>
                @error('tanggal_setoran')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-5">
            <div>
                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan / Nama pekerjaan tertulis di
                    kontrak</label>
                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="jenis_pekerjaan" type="text" class="form-control @error('jenis_pekerjaan') is-invalid @enderror" id="jenis_pekerjaan">
                @error('jenis_pekerjaan')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div>
                <label for="opd_penanggungjawab_anggaran" class="form-label">OPD PenanggungJawab Anggaran</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="opd_penanggungjawab_anggaran" id="opd_penanggungjawab_anggaran"
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
    <div class="row mb-3">
        <div class="col-lg-4">
            <div>
                <label for="no_kontrak" class="form-label">Nomor Kontrak</label>
                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="no_kontrak" type="text" class="form-control @error('no_kontrak') is-invalid @enderror" id="no_kontrak">
                @error('no_kontrak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <label for="tahun_berdasarkan_kontrak" class="form-label">Tahun berdasarkan Kontrak</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="tahun_berdasarkan_kontrak" id="tahun_berdasarkan_kontrak"
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
            <div>
                <label for="nilai_kontrak" class="form-label">Nilai Kontrak (Rp)</label>
                <input wire:dirty.class.remove="is-invalid" wire:model.lazy="nilai_kontrak" type="text" class="form-control @error('nilai_kontrak') is-invalid @enderror" id="nilai_kontrak">
                @error('nilai_kontrak')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-2">
            <div>
                <label for="status" class="status">Status</label>
                <select wire:dirty.class.remove="is-invalid" wire:model.lazy="status" class="form-select @error('status') is-invalid @enderror">
                    <option selected>Pilih salah satu</option>
                    @foreach($statusObj as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <h5 class="font-size-14 text-secondary mt-4 mb-3">
        <i class="mdi mdi-form-dropdown me-1"></i> Pendataan Bahan Baku
    </h5>
    <div class="row mb-3">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead class="text-center">
                <tr>
                    <th width="50%">Jenis Bahan Baku</th>
                    <th>Volume</th>
                    <th>Satuan</th>
                    <th width="5%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($bahanBakuTambang as $index => $jenis)
                    <tr>
                        <td>
                            <div wire:ignore.self>
                                <select wire:model="bahanBakuTambang.{{ $index }}.id_jenis_bahan_baku" name="bahanBakuTambang[{{ $index }}]['id_jenis_bahan_baku']"
                                        class="form-select form-select-sm">
                                    <option value="">Pilih Bahan Baku</option>
                                    @foreach($allBahanBaku as $bahan)
                                        <option wire:key="bahanbaku-{{$bahan->nama}}{{ $bahan->id }}" value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <input wire:model="bahanBakuTambang.{{ $index }}.jumlah_volume"
                                   name="bahanBakuTambang[{{ $index }}]['jumlah_volume']" value="{{ $jenis['jumlah_volume']}}"
                                   id="bahanBakuTambang[{{ $index }}]['jumlah_volume']" type="text" class="form-control form-control-sm">
                        </td>
                        <td>
                            <input wire:model="bahanBakuTambang.{{ $index }}.satuan"
                                   name="bahanBakuTambang[{{ $index }}]['satuan']" value="{{ $jenis['satuan'] }}"
                                   id="bahanBakuTambang[{{ $index }}]['satuan']" type="text" class="form-control form-control-sm">
                        </td>
                        <td colspan="text-center">
                            @if(isset($jenis['id_jenis_bahan_baku']) && !empty($jenis['id_jenis_bahan_baku']))
                                <button type="button" wire:click.prevent="removeBahanBakuTambang({{ $index }},{{ $jenis['id_jenis_bahan_baku'] }})" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            @else
                                <button type="button" wire:click.prevent="removeBahanBakuTambang({{ $index }}, null)" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <button type="button" wire:click.prevent="addBahanBakuTambang" class="btn btn-sm btn-soft-primary">
                            <i class="mdi mdi-plus"></i> Tambah Bahan Baku
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
{{--        <livewire:objek-pajak.form-op-bahan-baku />--}}
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const element = document.getElementById('nama_bahan_baku');
            new Choices(element, {
                removeItems: false,
                placeholderValue: 'This is a placeholder set in the config',
                searchPlaceholderValue: 'Ketikkan pencarian ...',
                noResultsText: 'Data tidak ditemukan',
                noChoicesText: 'Tidak ada terpilih',
                itemSelectText: '',
            });
        });
    </script>
@endpush
