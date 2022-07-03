<x-app-layout>
    @section('title') Laporan @endsection

    @push('css')
    @endpush
<!-- start page title -->
    <x-breadcrumb>
        <x-slot name="li_1">Dashboard</x-slot>
        <x-slot name="title">Laporan Pendapatan Asli Daerah</x-slot>
    </x-breadcrumb>
    <div class="content-header row">
        <div class="content-body">
        	<div class="row mt-4">
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Target Dan Realisasi</h4>
		                    <p class="card-text">Laporan pendapatan asli daerah berdasarkan target dan realisasi yang telah di capai.</p>
		                    <a href="{{ route('laporan-pajak.realisasi') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Jenis Pajak</h4>
		                    <p class="card-text">Laporan pendapatan asli daerah berdasarkan jenis pajak yang telah di tentukan oleh daerah.</p>
		                    <a href="{{ route('laporan-pajak.jenispajak') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Berdasarkan Wilayah</h4>
		                    <p class="card-text">Laporan pendapatan asli daerah berdasarkan wilayah yang di bagi sesuai kecamatannya.</p>
		                    <a href="{{ route('laporan-pajak.wilayah') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Metode Pembayaran</h4>
		                    <p class="card-text">Laporan pendapatan asli daerah berdasarkan pilihan cara membayar pajak.</p>
		                    <a href="{{ route('laporan-pajak.metodebayar') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Target Dan Realisasi OPD</h4>
		                    <p class="card-text">Laporan pengeluaran perangkat daerah berdasarkan target dan realisasi yang ada.</p>
		                    <a href="{{ route('laporan-pajak.realisasiopd') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
        		<div class="col-lg-4">
		            <div class="card">
		                <div class="card-body">
		                    <h4 class="card-title">Ringkasan Belanja OPD</h4>
		                    <p class="card-text">Laporan belanja perangkat daerah berdasarkan objek pajak.</p>
		                    <a href="{{ route('laporan-pajak.belanjaopd') }}" class="btn btn-primary">Lihat Laporan</a>
		                </div>
		            </div>
		        </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambang Mineral Wajib</h4>
                            <p class="card-text">Laporan wajib objek pajak tambang mineral.</p>
                            <a href="{{ route('laporan-pajak.tambangmineral') }}" class="btn btn-primary">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
	</div>
    @push('script')
    @endpush
</x-app-layout>
