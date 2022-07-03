<x-jet-dialog-modal :id="$modalId" wire:model="show">
    <form id="formTambahIzin" wire:submit.prevent="{{ $updateMode ? 'updatePermission' : 'storePermission' }}" class="needs-validation" novalidate>
        <x-slot name="title">
            {{ $updateMode ? __('Update Izin') : __('Tambah Izin') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-12">
                <label class="form-label" for="permission_name">Nama Izin</label>
                <input wire:model="state.name" type="text" id="permission_name"
                       class="form-control @error('name') is-invalid @enderror" placeholder="contoh : create_user, update_user, delete_user" autofocus
                />
                <x-jet-input-error for="name"/>
            </div>
            {{--                <div class="col-12 text-center">--}}
            {{--                    <button type="submit" class="btn btn-primary mt-2 me-1" wire:loading.attr="disabled">--}}
            {{--                        {{ $updateMode ? 'Update Izin' : 'Buat Izin' }}--}}
            {{--                    </button>--}}
            {{--                    <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-secondary mt-2">Batal</button>--}}
            {{--                </div>--}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="$emit('resetField')" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-jet-secondary-button>

            <x-jet-button  type="submit" wire:click="submit" class="ms-2" wire:loading.attr="disabled">
                {{ $updateMode ? __('Update') : __('Simpan') }}
            </x-jet-button>
        </x-slot>
    </form>
</x-jet-dialog-modal>
