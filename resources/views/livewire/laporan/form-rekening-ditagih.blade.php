<div>
    <form class="form form-horizontal">
        <div class="row">
            <div class="col-md-6 col-4">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="first-name">Pilih Zona / Wilayah</label>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select">
                                    <option>Zona 1</option>
                                    <option>Zona 2</option>
                                    <option>Zona 3</option>
                                    <option>Zona 4</option>
                                    <option>Zona 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-4">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptions"
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
                            <div class="col-sm-3">
                                <label class="col-form-label" for="contact-info">Golongan Tarif</label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" name="filter[golongan]">
                                    <option value="">Pilih Golongan</option>
                                    @foreach($listGolongan as $kode => $golongan)
                                        <option value="{{ $kode }}">{{ $golongan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-6 col-8">
                <div class="row">
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
                </div>
            </div>
            <hr>
            <div class="col-md-8 col-8">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptions"
                                        id="inlineRadio1"
                                        value="option1"
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
                                        name="inlineRadioOptions"
                                        id="inlineRadio1"
                                        value="option1"
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
                                        name="inlineRadioOptions"
                                        id="inlineRadio1"
                                        value="option1"
                                        checked
                                    />
                                    <label class="form-check-label" for="inlineRadio1">Cetak Per Kelompok / Golongan</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptions"
                                        id="inlineRadio1"
                                        value="option1"
                                        checked
                                    />
                                    <label class="form-check-label" for="inlineRadio1">Cetak Rinci Menurut : </label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="p-1 rounded border-secondary">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="inlineRadioOptions"
                                            id="inlineRadio1"
                                            value="option1"
                                            checked
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Checked</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="inlineRadioOptions"
                                            id="inlineRadio2"
                                            value="option2"
                                        />
                                        <label class="form-check-label" for="inlineRadio2">Unchecked</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="inlineRadioDisabledOptions"
                                            id="inlineRadio3"
                                            value="option3"
                                            checked
                                            disabled
                                        />
                                        <label class="form-check-label" for="inlineRadio3">Checked disabled</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--    <div class="row">--}}
            {{--        <div class="col-12">--}}
            {{--            <div class="card">--}}
            {{--                <div class="card-header"></div>--}}
            {{--                <div class="card-body">--}}
            {{--                    <form action="{{ route('laporan-pajak.daftar-rekening-ditagih') }}">--}}
            {{--                        <div class="col-md-3">--}}
            {{--                            <input name="filter[periode_range]" data-input--}}
            {{--                                   type="text"--}}
            {{--                                   id="fp-range"--}}
            {{--                                   value="{{ $filter['periode_range'] ?? '' }}"--}}
            {{--                                   class="form-control flatpickr-input flatpickr-range"--}}
            {{--                                   placeholder="YYYY-MM-DD to YYYY-MM-DD"--}}
            {{--                            />--}}
            {{--                            --}}{{--                                        <x-inputs.flatpickr name="periode_range" :value="$filter['periode_range'] ?? ''" />--}}
            {{--                        </div>--}}
            {{--                        <div class="col-md-2">--}}
            {{--                            <select class="form-select" name="filter[zona]">--}}
            {{--                                <option value="">Pilih Zona</option>--}}
            {{--                                @foreach($listZona as $kode => $wilayah)--}}
            {{--                                    <option value="{{ $kode }}">{{ $wilayah }}</option>--}}
            {{--                                @endforeach--}}
            {{--                            </select>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-md-2">--}}
            {{--                            <select class="form-select" name="filter[golongan]">--}}
            {{--                                <option value="">Pilih Golongan</option>--}}
            {{--                                @foreach($listGolongan as $kode => $golongan)--}}
            {{--                                    <option value="{{ $kode }}">{{ $golongan }}</option>--}}
            {{--                                @endforeach--}}
            {{--                            </select>--}}
            {{--                        </div>--}}
            {{--                        <div>--}}
            {{--                            <button type="submit" class="btn btn-primary">Filter</button>--}}
            {{--                        </div>--}}
            {{--                        <div>--}}
            {{--                            <button id="btnReset" class="btn btn-info">Reset</button>--}}
            {{--                        </div>--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--                <div class="card-footer"></div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            {{--    </div>--}}
        </div>
    </form>
</div>
