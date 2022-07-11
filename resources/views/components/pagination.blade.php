@props(['datalinks' => null,'page' => 1,'pageCount' => 15,'totalData' => 0])
{{--@if($page > 1)--}}
<div class="d-flex justify-content-between align-items-start">
    <div>
        <div class="text-muted" role="status" aria-live="polite">
            Menampilkan {{ $page }} sampai {{ $pageCount }} dari {{ $totalData }} entri
        </div>
    </div>
    {{--    <div class="col-sm-12 col-md-2 text-center">--}}
    {{--        <div class="flex inline-flex">--}}
    {{--            <label>--}}
    {{--                <select wire:model="perPage" class="form-select">--}}
    {{--                    <option value="15">15</option>--}}
    {{--                    <option value="25">25</option>--}}
    {{--                    <option value="50">50</option>--}}
    {{--                    <option value="100">100</option>--}}
    {{--                </select>--}}
    {{--            </label>--}}
    {{--            <label>Halaman</label>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{ $datalinks->links() }}
    {{--    <div class="col-md-6 mt-1 bg-info">--}}
    {{--        {{ $datalinks->links() }}--}}
    {{--    </div>--}}
</div>
{{--@endif--}}
