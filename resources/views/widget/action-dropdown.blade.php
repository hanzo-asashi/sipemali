@can('manage-jenis-wajib-pajak')
    <x-dropdown class="dropdown">
        <x-button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
            <i class="bx bx-dots-horizontal-rounded"></i>
        </x-button>
        <x-ul-list class="dropdown-menu dropdown-menu-end">
            @can('edit-jenis-wajib-pajak')
                <li>
                    <x-button wire:key="{{ $wp->id }}" wire:click.prevent="edit({{ $wp }})" class="dropdown-item">
                        Edit
                    </x-button>
                </li>
            @endcan
            @can('delete-jenis-wajib-pajak')
                <li>
                    <x-button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $wp->id }},'single')">Hapus</x-button>
                </li>
            @endcan
        </x-ul-list>
    </x-dropdown>
@endcan
