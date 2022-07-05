@props(['title' => 'Dashboard', 'breadcrumbs' => []])
@php
    $breadcrumbs = $breadcrumbs ?? [];
@endphp
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{-- this will load breadcrumbs dynamically from controller --}}
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item">
                            @if(isset($breadcrumb['link']))
                                <a href="{{ $breadcrumb['link'] === 'javascript:void(0)' ? $breadcrumb['link']: route($breadcrumb['link']) }}">
                                    @endif
                                    {{$breadcrumb['name']}}
                                    @if(isset($breadcrumb['link']))
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ol>
{{--                <ol class="breadcrumb m-0">--}}
{{--                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $li_1 }}</a></li>--}}
{{--                    @if(isset($title))--}}
{{--                        <li class="breadcrumb-item active">{{ $title }}</li>--}}
{{--                    @endif--}}
{{--                </ol>--}}
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
