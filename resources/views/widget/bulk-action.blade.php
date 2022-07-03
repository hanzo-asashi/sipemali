<!-- Bulk Action Start -->
@if($checked)
    <label class="form-label" for="form-sm-input">Aksi</label>
    <x-dropdown>
        <x-button class="btn-sm btn-outline-secondary me-50" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Terpilih <span class="badge rounded-pill bg-danger">{{ count($checked) }}</span>
            <i class="bx bx-chevron-down"></i>
        </x-button>
        <x-dropdown-item>
            <x-nav-link wire:click="$emit('triggerDelete','deleteBulk','bulk')" class="dropdown-item btn-sm">
                <span class="align-middle">Hapus Terpilih</span>
            </x-nav-link>
        </x-dropdown-item>
    </x-dropdown>
@endif
<!-- Bulk Action End -->
