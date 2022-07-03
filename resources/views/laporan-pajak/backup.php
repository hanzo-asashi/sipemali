<x-app-layout>
    @section('title') Laporan @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
        	<div class="card-body p-0">
        		<div class="row">
                    <div class="col-md-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#realisasi" role="tab" aria-controls="v-pills-home" aria-selected="true">Target Dan Realisasi</a>
                            <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#jenis-pajak" role="tab" aria-controls="v-pills-messages" aria-selected="false">Jenis Pajak Daerah</a>
                            <a class="nav-link mb-2" id="v-pills-settings-tab" data-bs-toggle="pill" href="#wilayah" role="tab" aria-controls="v-pills-settings" aria-selected="false">Berdasarkan Wilayah</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#metode-bayar" role="tab" aria-controls="v-pills-settings" aria-selected="false">Metode Pembayaran</a>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-10">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="realisasi" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            	<div class="card bg-soft-light border-primary">
                            		<div class="card-body p-2">
                            			<form>
                            				<div class="row">
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Periode</label>
							                            <select class="form-select form-select-sm">
							                            	<option>Tahun</option>
							                            	<option>Semester</option>
							                            	<option>Triwulan</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-1">
	                            					<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 28px;">Filter</button>
	                            				</div>
                            				</div>
                            			</form>
                            		</div>
                            	</div>
                                <div class="table-responsive">
			                        <table class="table table-bordered border-primary font-size-12 mb-0">
			                            <thead class="text-center" style="background: #f9f9f9;">
			                                <tr>
			                                    <th rowspan="2">Kode Rek</th>
			                                    <th rowspan="2" width="40%">Uraian</th>
			                                    <th rowspan="2">Target Pajak</th>
			                                    <th colspan="2">Realisasi</th>
			                                    <th rowspan="2">%</th>
			                                    <th rowspan="2">Sisah</th>
			                                </tr>
			                                <tr>
			                                	<th>2020</th>
			                                	<th>2021</th>
			                                </tr>
			                                <tr class="font-size-10" style="background: #f5f5f5;">
			                                    <th>I</th>
			                                    <th>II</th>
			                                    <th>III</th>
			                                    <th colspan="2">IV</th>
			                                    <th>V</th>
			                                    <th>VI</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr>
			                                	<th style="text-align: center;">4.1</th>
			                                	<th>PENDAPATAN PAJAK DAERAH</th>
			                                	<th style="text-align: right;">Rp. 1.520.000.000</th>
			                                	<th style="text-align: right;">Rp. 545.000.000</th>
			                                	<th style="text-align: right;">Rp. 320.000.000</th>
			                                	<th style="text-align: center;">86%</th>
			                                	<th style="text-align: right;">Rp. 210.000.000</th>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.1</td>
			                                	<td>Pajak Hotel</td>
			                                	<td style="text-align: right;">Rp. 321.000.000</td>
			                                	<td style="text-align: right;">Rp. 175.000.000</td>
			                                	<td style="text-align: right;">Rp. 380.000.000</td>
			                                	<td style="text-align: center;">79%</td>
			                                	<td style="text-align: right;">Rp. 134.000.000</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.2</td>
			                                	<td>Pajak Rumah Makan</td>
			                                	<td style="text-align: right;">Rp. 220.000.000</td>
			                                	<td style="text-align: right;">Rp. 135.000.000</td>
			                                	<td style="text-align: right;">Rp. 320.000.000</td>
			                                	<td style="text-align: center;">73%</td>
			                                	<td style="text-align: right;">Rp. 120.000.000</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.3</td>
			                                	<td>Pajak Reklame</td>
			                                	<td style="text-align: right;">Rp. 670.000.000</td>
			                                	<td style="text-align: right;">Rp. 345.000.000</td>
			                                	<td style="text-align: right;">Rp. 220.000.000</td>
			                                	<td style="text-align: center;">69%</td>
			                                	<td style="text-align: right;">Rp. 155.000.000</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.4</td>
			                                	<td>Pajak Tambang Dan Mineral</td>
			                                	<td style="text-align: right;">Rp. 250.000.000</td>
			                                	<td style="text-align: right;">Rp. 190.000.000</td>
			                                	<td style="text-align: right;">Rp. 420.000.000</td>
			                                	<td style="text-align: center;">79%</td>
			                                	<td style="text-align: right;">Rp. 210.000.000</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.5</td>
			                                	<td>Pajak Penerangan Jalan Umum</td>
			                                	<td style="text-align: right;">Rp. 320.000.000</td>
			                                	<td style="text-align: right;">Rp. 166.000.000</td>
			                                	<td style="text-align: right;">Rp. 60.000.000</td>
			                                	<td style="text-align: center;">79%</td>
			                                	<td style="text-align: right;">Rp. 100.000.000</td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
                            </div>
                            <div class="tab-pane fade" id="jenis-pajak" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card bg-soft-light border-primary">
                            		<div class="card-body p-2">
                            			<form>
                            				<div class="row">
	                            				<div class="col-md-3">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Jenis Pajak</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>Pajak Hotel</option>
							                            	<option>Pajak Rumah Makan</option>
							                            	<option>Pajak Reklame</option>
							                            	<option>Pajak Tambang Dan Mineral</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Tahun</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>2020</option>
							                            	<option>2021</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-1">
	                            					<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 28px;">Filter</button>
	                            				</div>
                            				</div>
                            			</form>
                            		</div>
                            	</div>
                                <div class="table-responsive">
			                        <table class="table table-bordered border-primary font-size-12 mb-0">
			                            <thead class="text-center" style="background: #f9f9f9;">
			                                <tr>
			                                    <th rowspan="2">Kode Rek</th>
			                                    <th rowspan="2" width="20%">Uraian</th>
			                                    <th colspan="12">Bulan</th>
			                                    <th rowspan="2">Capaian</th>
			                                </tr>
			                                <tr>
			                                	<th>1</th>
			                                	<th>2</th>
			                                	<th>3</th>
			                                	<th>4</th>
			                                	<th>5</th>
			                                	<th>6</th>
			                                	<th>7</th>
			                                	<th>8</th>
			                                	<th>9</th>
			                                	<th>10</th>
			                                	<th>11</th>
			                                	<th>12</th>
			                                </tr>
			                                <tr class="font-size-10" style="background: #f5f5f5;">
			                                    <th>I</th>
			                                    <th>II</th>
			                                    <th>III</th>
			                                    <th>IV</th>
			                                    <th>V</th>
			                                    <th>VI</th>
			                                    <th>VII</th>
			                                    <th>VIII</th>
			                                    <th>IX</th>
			                                    <th>X</th>
			                                    <th>XI</th>
			                                    <th>XII</th>
			                                    <th>XIII</th>
			                                    <th>XIV</th>
			                                    <th>XV</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr>
			                                	<td style="text-align: center;">4.1.1</td>
			                                	<td>Pajak Hotel</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.2</td>
			                                	<td>Pajak Rumah Makan</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.3</td>
			                                	<td>Pajak Reklame</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.4</td>
			                                	<td>Pajak Tambang Dan Mineral</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4.1.5</td>
			                                	<td>Pajak Penerangan Jalan Umum</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
                            </div>
                            <div class="tab-pane fade" id="wilayah" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="card bg-soft-light border-primary">
                            		<div class="card-body p-2">
                            			<form>
                            				<div class="row">
	                            				<div class="col-md-3">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Kecamatan</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>Batu Putih</option>
							                            	<option>Katoi</option>
							                            	<option>Kodeoha</option>
							                            	<option>Lambai</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Tahun</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>2020</option>
							                            	<option>2021</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Bulan</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>Januari</option>
							                            	<option>Februari</option>
							                            	<option>Maret</option>
							                            	<option>April</option>
							                            	<option>Mei</option>
							                            	<option>Juni</option>
							                            	<option>Juli</option>
							                            	<option>Agustus</option>
							                            	<option>September</option>
							                            	<option>Oktober</option>
							                            	<option>November</option>
							                            	<option>Desember</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-1">
	                            					<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 28px;">Filter</button>
	                            				</div>
                            				</div>
                            			</form>
                            		</div>
                            	</div>
                                <div class="table-responsive">
			                        <table class="table table-bordered border-primary font-size-12 mb-0">
			                            <thead class="text-center" style="background: #f9f9f9;">
			                                <tr>
			                                    <th rowspan="2">No.</th>
			                                    <th rowspan="2" width="20%">Kecamatan</th>
			                                    <th colspan="5">Jenis Pajak</th>
			                                    <th rowspan="2">Capaian</th>
			                                </tr>
			                                <tr>
			                                	<th width="12%">Hotel</th>
			                                	<th width="12%">Rumah Makan</th>
			                                	<th width="12%">Reklame</th>
			                                	<th width="12%">Tambang Mineral</th>
			                                	<th width="12%">PJU</th>
			                                </tr>
			                                <tr class="font-size-10" style="background: #f5f5f5;">
			                                    <th>I</th>
			                                    <th>II</th>
			                                    <th>III</th>
			                                    <th>IV</th>
			                                    <th>V</th>
			                                    <th>VI</th>
			                                    <th>VII</th>
			                                    <th>VIII</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr>
			                                	<td style="text-align: center;">1</td>
			                                	<td>Batu Putih</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">2</td>
			                                	<td>Katoi</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">3</td>
			                                	<td>Kodeoha</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">4</td>
			                                	<td>Lambai</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">5</td>
			                                	<td>Lasusua</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                	<td style="text-align: right;">Rp. 0</td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
                            </div>
                            <div class="tab-pane fade" id="metode-bayar" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="card bg-soft-light border-primary">
                            		<div class="card-body p-2">
                            			<form>
                            				<div class="row">
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Metode Bayar</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>BANK</option>
							                            	<option>Kantor BAPENDA</option>
							                            	<option>Transfer</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Tahun</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>2020</option>
							                            	<option>2021</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-2">
	                            					<div>
							                            <label class="form-label" for="form-sm-input">Bulan</label>
							                            <select class="form-select form-select-sm">
							                            	<option></option>
							                            	<option>Januari</option>
							                            	<option>Februari</option>
							                            	<option>Maret</option>
							                            	<option>April</option>
							                            	<option>Mei</option>
							                            	<option>Juni</option>
							                            	<option>Juli</option>
							                            	<option>Agustus</option>
							                            	<option>September</option>
							                            	<option>Oktober</option>
							                            	<option>November</option>
							                            	<option>Desember</option>
							                            </select>
							                        </div>
	                            				</div>
	                            				<div class="col-md-1">
	                            					<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 28px;">Filter</button>
	                            				</div>
                            				</div>
                            			</form>
                            		</div>
                            	</div>
                                <div class="table-responsive">
			                        <table class="table table-bordered border-primary font-size-12 mb-0">
			                            <thead class="text-center" style="background: #f9f9f9;">
			                                <tr>
			                                    <th rowspan="2">No.</th>
			                                    <th rowspan="2" width="20%">Metode Pembayaran</th>
			                                    <th colspan="5">Jenis Pajak</th>
			                                    <th rowspan="2">Total Transaksi</th>
			                                </tr>
			                                <tr>
			                                	<th width="15%">Hotel</th>
			                                	<th width="15%">Rumah Makan</th>
			                                	<th width="15%">Reklame</th>
			                                	<th width="15%">Tambang Mineral</th>
			                                	<th width="15%">PJU</th>
			                                </tr>
			                                <tr class="font-size-10" style="background: #f5f5f5;">
			                                    <th>I</th>
			                                    <th>II</th>
			                                    <th>III</th>
			                                    <th>IV</th>
			                                    <th>V</th>
			                                    <th>VI</th>
			                                    <th>VII</th>
			                                    <th>VIII</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <tr>
			                                	<td style="text-align: center;">1</td>
			                                	<td>BANK</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">2</td>
			                                	<td>Kantor BAPENDA</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                </tr>
			                                <tr>
			                                	<td style="text-align: center;">3</td>
			                                	<td>Transfer</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                	<td style="text-align: right;">0</td>
			                                </tr>
			                            </tbody>
			                        </table>
			                    </div>
                            </div>
                        </div>
                    </div><!--  end col -->
                </div>
            </div>
        </div>
	</div>
    @push('script')
    @endpush
</x-app-layout>





