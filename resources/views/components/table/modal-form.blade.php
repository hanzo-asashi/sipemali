<x-form {{ $attributes->merge(['class' => 'add-new-user modal-content pt-0']) }}>
{{--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>--}}
  <x-modal.modal-header class="modal-header mb-1">
    {{ $modalTitle }}
  </x-modal.modal-header>
  <x-modal.modal-body class="flex-grow-1">
    {{ $slot }}
  </x-modal.modal-body>
</x-form>
