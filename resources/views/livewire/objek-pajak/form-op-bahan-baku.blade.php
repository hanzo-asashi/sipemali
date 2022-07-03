<div>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead class="text-center">
            <tr>
                <th width="50%">Jenis Bahan Baku</th>
                <th>Satuan</th>
                <th>Nilai</th>
                <th width="5%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($bahanBakuTambang as $index => $jenis)
                <tr>
                    <td>
                        <select wire:model="bahanBakuTambang.{{ $index }}.nama" name="bahanBakuTambang[{{ $index }}]['nama']"
                                id="bahanBakuTambang[{{ $index }}]['nama']" class="form-select form-select-sm">
                            <option value="">Pilih Bahan Baku</option>
                            @foreach($allBahanBaku as $bahan)
                                <option wire:key="bahan-{{ $bahan->id }}" value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select disabled wire:model=bahanBakuTambang.{{$index}}.satuan name="bahanBakuTambang[{{ $index }}]['satuan']"
                                id="bahanBakuTambang[{{ $index }}]['satuan']"
                                data-trigger class="form-select form-select-sm">
                            <option value="" selected>Pilih Satuan</option>
                            <option value="m3">M3</option>
                        </select>
                    </td>
                    <td>
                        <input readonly wire:model="bahanBakuTambang.{{ $index }}.nilai" name="bahanBakuTambang[{{ $index }}]['nilai']" value="{{ $jenis['nilai'] }}"
                               id="bahanBakuTambang[{{ $index }}]['nilai']" type="text" class="form-control
                        form-control-sm">
                    </td>
                    <td colspan="text-center">
                        <a wire:click.prevent="removeBahanBakuTambang({{ $index }})" class="btn btn-sm btn-danger"><i class="mdi mdi-delete-outline"></i></a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <button type="button" wire:click.prevent="addBahanBakuTambang" class="btn btn-sm btn-light"><i class="mdi mdi-plus"></i> Tambah Data</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
