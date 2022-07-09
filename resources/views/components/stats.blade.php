@props(['value' => 0,'jumlah' => 0 ,'title' => '', 'icon' => 'avatar', 'iconColor' => 'primary', 'color' => 'bg-light-primary', 'text' => ''])

<div {{ $attributes->merge(['class' => '']) }} class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card">
        <!-- card body -->
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-12">
                    <span class="text-{{ $color }} mb-4 lh-1 d-block">{{ $title }}</span>
                    <h4 class="mb-1">
                        <i class="bx bx-{{ $icon }} text-{{ $color }}"></i>&nbsp;&nbsp;
                        <span>{{ \App\Utilities\Helpers::simplify($value) }}</span>
                        <span class="lead">{{ $text }}</span>
                    </h4>
                    {{--                    <div class="text-nowrap mt-2">--}}
                    {{--                        <span class="badge bg-soft-danger text-danger">-29 Trades</span>--}}
                    {{--                        <span class="ms-1 text-muted font-size-13">Since last week</span>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div><!-- end card body -->
    </div><!-- end card -->
</div><!-- end col -->

{{--<div {{ $attributes->merge(['class' => '']) }} class="col-lg-3 col-sm-6">--}}
{{--    <div class="card">--}}
{{--        <div class="card-body d-flex align-items-center justify-content-between">--}}
{{--            <div>--}}
{{--                <h3 class="fw-bolder mb-75">{{ \App\Utilities\Helpers::number_format_short($value) }}</h3>--}}
{{--                <span>{{ $title }}</span>--}}
{{--                <span class="badge bg-light-primary">{{ $jumlah }}</span>--}}
{{--            </div>--}}
{{--            <div class="{{ $icon }} {{ $color }} p-50">--}}
{{--                <span class="avatar-content">--}}
{{--                    {{ $slot }}--}}
{{--                </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
