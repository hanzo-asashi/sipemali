<!-- Bulk Action Start -->
@if($checked)
    <x-dropdown>
        <x-button class="btn btn-outline-secondary waves-effect waves-float waves-light me-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pilih Aksi <span class="badge rounded-pill bg-danger">{{ count($checked) }}</span>
            <i class="fa fa-chevron-down"></i>
        </x-button>
        <x-dropdown-item>
            <x-nav-link wire:click="$emit('triggerDelete','delete','bulk')" class="dropdown-item">
                <span class="align-middle"><i class="far fa-trash-alt"></i> Hapus Terpilih</span>
            </x-nav-link>
        </x-dropdown-item>
    </x-dropdown>
@endif
<!-- Bulk Action End -->
