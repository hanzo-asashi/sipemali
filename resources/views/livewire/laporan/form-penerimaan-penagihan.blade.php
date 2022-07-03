<div>
    <div class="row">
        <div class="col-10">
            <div class="card bg-light border-secondary rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form form-horizontal">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="zona">Pilih Zona / Wilayah</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select wire:model="zonaWilayah" id="zona" name="zona" class="form-select">
                                                    <option value="">Pilih Zona</option>
                                                    @foreach($listZona as $key => $zona)
                                                        <option value="{{ $key }}">{{ $zona }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-4">
                            <div class="card bg-light border-secondary">
                                <div class="card-body">
                                    <form class="form form-horizontal" wire:submit.prevent="submitPeriodePenjualan">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="periodePenjualan"
                                                            id="inlineRadio1"
                                                            value="option1"
                                                            checked
                                                        />
                                                        <label class="form-check-label" for="inlineRadio1">Semua Periode</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-4">
                                                    <div class="mb-1">
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                           type="radio"
                                                                           name="periodePenjualan"
                                                                           id="inlineRadio1"
                                                                           value="option1"/>
                                                                    <label class="form-check-label" for="customRadio1"></label>
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" />
                                                            <input type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-light border-secondary">
                                        <div class="card-body">
                                            <form class="form form-horizontal" wire:submit.prevent="submitPeriodePencetakan">
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label" for="first-name">Periode</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input name="filter[periode_range]" data-input
                                                                   type="text"
                                                                   id="fp-range"
                                                                   value="{{ $filter['periode_range'] ?? '' }}"
                                                                   class="form-control flatpickr-input flatpickr-range"
                                                                   placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider divider-start divider-success">
                            <div class="divider-text">Pilihan</div>
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="row">
                                <div class="col-12">
                                    <form class="form form-horizontal" wire:submit.prevent="submitPilihan">
                                        <div class="mb-1 row">
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input wire:model="periodeCetak"
                                                           class="form-check-input"
                                                           type="radio"
                                                           name="periodeCetak"
                                                           id="inlineRadio1"
                                                           value="cetakIkhtisar"
                                                           checked
                                                    />
                                                    <label class="form-check-label" for="inlineRadio1">Cetak Ikhtisar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="periodeCetak"
                                                        id="inlineRadio1"
                                                        value="cetakPerZona"
                                                        checked
                                                    />
                                                    <label class="form-check-label" for="inlineRadio1">Cetak Per Zona</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="periodeCetak"
                                                        id="inlineRadio1"
                                                        value="cetakKelompok"
                                                        checked
                                                    />
                                                    <label class="form-check-label" for="inlineRadio1">Cetak Per Kelompok / Golongan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col-sm-4">
                                                <div class="mb-1">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="periodeCetak"
                                                                       id="inlineRadio1"
                                                                       value="cetakKelompok"/>
                                                                <label class="form-check-label" for="customRadio1"></label>
                                                            </div>
                                                        </div>
                                                        <select class="form-select">
                                                            <option value="">Pilih Pilihan</option>
                                                            <option value="1">Nomor</option>
                                                            <option value="2">Kelompok</option>
                                                            <option value="3">Zona/Wilayah</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="periodeCetak"
                                                        id="inlineRadio1"
                                                        value="kasir"
                                                    />
                                                    <label class="form-check-label" for="inlineRadio1">Kasir</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
