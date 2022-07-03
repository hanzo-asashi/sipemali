<x-modal :id="'modal-alamat'" :title="'Alamat'" :maxWidth="''" :update-mode="$updateMode">
    <form wire:submit.prevent="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}" class="needs-validation" novalidate>
        <div class="modal-body">
            <x-jet-label for="alamat" :value="'Alamat'"/>
            <div class="mb-1">
                <x-jet-input class="@error('address.alamat') is-invalid @enderror" wire:model="address.alamat" type="text" label="Alamat" placeholder="Alamat"></x-jet-input>
                <x-jet-input-error :for="'alamat'"></x-jet-input-error>
            </div>
            <x-jet-label for="blok" :value="'Blok'" />
            <div class="mb-1">
                <x-jet-input class="@error('blok') is-invalid @enderror" wire:model="address.blok" type="text" label="Blok" placeholder="Blok"></x-jet-input>
                <x-jet-input-error :for="'blok'"></x-jet-input-error>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ $updateMode ? 'Update' : 'Simpan' }}</button>
        </div>
    </form>
</x-modal>

{{--<x-jet-dialog-modal wire:model="{{ $show }}" :id="$modalId">--}}
{{--    <x-slot name="title">--}}
{{--        {{ $updateMode ? 'Ubah Alamat' : 'Buat Alamat' }}  {{ $updateMode }}--}}
{{--    </x-slot>--}}
{{--    <x-slot name="content">--}}
{{--        <x-jet-validation-errors :errors="$errors"></x-jet-validation-errors>--}}
{{--        <form wire:submit.prevent="{{ $updateMode ? 'updateAlamat' : 'storeAlamat' }}" class="needs-validation" novalidate>--}}
{{--            <x-jet-label for="alamat" :value="'Alamat'"/>--}}
{{--            <div class="mb-1">--}}
{{--                <x-jet-input class="@error('alamat') invalid @enderror" wire:model.defer="alamat" type="text" label="Alamat" placeholder="Alamat"></x-jet-input>--}}
{{--            </div>--}}
{{--            <x-jet-input-error :for="'alamat'">--}}
{{--                <x-slot name="message">{{ $message ?? null }}</x-slot>--}}
{{--            </x-jet-input-error>--}}
{{--            <x-jet-label for="blok" :value="'Blok'"/>--}}
{{--            <div class="mb-1">--}}
{{--                <x-jet-input class="@error('blok') invalid @enderror" wire:model.defer="blok" type="text" label="Blok" placeholder="Blok"></x-jet-input>--}}
{{--            </div>--}}
{{--            <x-jet-input-error :for="'blok'">--}}
{{--                <x-slot name="message">{{ $message ?? null }}</x-slot>--}}
{{--            </x-jet-input-error>--}}
{{--            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">--}}
{{--                {{ $updateMode ? 'Ubah' : 'Simpan' }}--}}
{{--            </button>--}}
{{--            <button type="button" wire:click.prevent="$emit('resetField')" data-bs-dismiss="modal" class="btn btn-danger">Batal</button>--}}
{{--        </form>--}}
{{--    </x-slot>--}}
{{--    <x-slot name="footer"></x-slot>--}}
{{--</x-jet-dialog-modal>--}}
