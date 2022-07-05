@props(['id', 'maxWidth', 'modal' => false, 'updateMode' => false,'title' => ''])

@php
    $id = $id ?? md5($attributes->wire('model'));

    match ($maxWidth ?? ''){
        'xs' => $maxWidth = 'modal-xs',
        'sm' => $maxWidth = 'modal-sm',
        'md' => $maxWidth = 'modal-md',
        'lg' => $maxWidth = 'modal-lg',
        'xl' => $maxWidth = 'modal-xl',
        'full' => $maxWidth = 'modal-fullscreen',
        '' => $maxWidth = '',
    };
    $title = $updateMode ? 'Ubah ' .$title : 'Tambah '.$title
@endphp

<div
    class="modal fade text-start"
    id="{{ $id }}"
    tabindex="-1"
    aria-labelledby="{{ $id }}"
    aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false"
    wire:ignore.self
>
    <div class="modal-dialog modal-dialog-centered {{ $maxWidth }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $id .'-title' }}">{{ $title }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
