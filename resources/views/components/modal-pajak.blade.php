@props(['formAction' => false, 'modalFooter' => false, 'modalTitle' => ''])
<div>
    <div {{ $attributes->merge(['class' => 'modal fade', 'id' => 'modalDetailBayar']) }} data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="{{ $modalTitle }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if(isset($modalTitle))
                        <h5 class="modal-title">
                            {{ $modalTitle }}
                        </h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($formAction)
                        <form wire:submit.prevent="{{ $formAction }}">
                    @endif
                    {{ $slot }}
                    @if($formAction)
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    @if($modalFooter)
                        {{ $modalFooter }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
