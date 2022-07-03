<div>
    <div class="text-center p-5">
        <h5>TRACKING PEMBAYARAN</h5>
        <p class="text-white">Masukkan NOPD, NIB atau nomor kependudukan anda, untuk mengetahui status pembyaran objek pajak</p>
        <form wire:submit.prevent="submit" class="app-search d-lg-block mt-4">
            <div class="position-relative">
                <input wire:model.lazy="search" type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-primary" type="submit"><i class="bx bx-search-alt align-middle"></i></button>
            </div>
        </form>
    </div>
</div>



