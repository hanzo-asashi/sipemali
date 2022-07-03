@props(['useImage' => false, 'colspan' => 10])

<tr>
    <td colspan="{{ $colspan }}" {{ $attributes->merge(['class' => 'text-center text-muted font-size-16']) }} class="">
        @if($useImage)
            <img src="{{ asset('assets/images/no-data-found.png') }}" alt="No data" class="img-responsive img-fluid">
        @else
            <span class="d-block">{{ __('Maaf, data tidak ditemukan. Silahkan input data terlebih dahulu.') }}</span>
        @endif
    </td>
</tr>
