@props(['tipe' => 'border', 'target' => '', 'size' => 'sm'])

<span wire:loading.delay.shorter class="spinner-{{ $tipe }} spinner-{{ $tipe }}-{{ $size }}" role="status"
      aria-hidden="true" {{ $attributes }} wire:target="{{$target}}"></span>
