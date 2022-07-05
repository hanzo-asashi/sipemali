@props(['value' => 0,'jumlah' => 0 ,'title' => '', 'icon' => 'avatar', 'color' => 'bg-light-primary'])

<div {{ $attributes->merge(['class' => '']) }} class="col-lg-3 col-sm-6">
    <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h3 class="fw-bolder mb-75">{{ \App\Utilities\Helpers::number_format_short($value) }}</h3>
                <span>{{ $title }}</span>
{{--                <span class="badge badge-light-primary">{{ $jumlah }}</span>--}}
            </div>
            <div class="{{ $icon }} {{ $color }} p-50">
                <span class="avatar-content">
                    {{ $slot }}
                </span>
            </div>
        </div>
    </div>
</div>
