@props(['tipe' => 'border', 'target' => ''])

{{--<span class="spinner-{{ $tipe }} spinner-{{ $tipe }}-sm" {{ $attributes->merge(['role' => 'status','aria-hidden' => true]) }}></span>--}}
<span wire:loading.delay.shorter class="spinner-{{ $tipe }} spinner-{{ $tipe }}-sm" role="status"
      aria-hidden="true" {{ $attributes }}></span>
