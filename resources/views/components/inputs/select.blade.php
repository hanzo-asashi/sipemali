<div wire:ignore
     x-data="{}"
     x-init="() => {
         //document.addEventListener('DOMContentLoaded', function () {
            const choices = new Choices($refs.{{ $attributes['prettyname'] }}, {
                itemSelectText: '',
                noResultsText: 'Data tidak ditemukan',
                noChoicesText: 'Tidak ada terpilih',
                searchPlaceholderValue: 'Ketik pencarian disini',
            });
            choices.passedElement.element.addEventListener('change', function(event) {
                values = event.detail.value;
                @this.set('{{ $attributes['wire:model'] }}', values);
              }, false);
            let selected = parseInt(@this.get{!! $attributes['selected'] !!}).toString();
            choices.setChoiceByValue(selected);
        //});
	}"
>
    <select class="form-select form-control" id="{{ $attributes['prettyname'] }}" wire:model="{{ $attributes['wire:model'] }}" selected="{{ $attributes['selected'] }}"
            wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $attributes['prettyname']}}"
    >
        <option value="">{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : 'Pilih Opsi' }}</option>
        @if(count($attributes['options'])>0)
            @foreach($attributes['options'] as $key=>$option)
                <option wire:key="{{$attributes['prettyname'].'-'.$key}}" value="{{$key}}">{{$option}}</option>
            @endforeach
        @endif
    </select>
</div>
