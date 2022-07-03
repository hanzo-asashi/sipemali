<div>
    @section('title', $title)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-sm-6 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                            <div class="me-1">
                                <input wire:model="search" value="{{ $search }}" type="search" class="form-control" placeholder="Search...">
                            </div>
                        </div>
{{--                        <div class="col-sm-6 col-lg-6 d-flex justify-content-center justify-content-lg-end">--}}
{{--                            <div class="d-flex align-items-center justify-content-center justify-content-lg-end">--}}
{{--                                <div class="dropdown me-1">--}}
{{--                                    <button class="btn btn-icon btn-primary waves-effect waves-float waves-light" type="button"--}}
{{--                                            id="dropdownMenuButton6"--}}
{{--                                            data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                        <i data-feather="grid"></i>--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">--}}
{{--                                        <a class="dropdown-item" href="#">Option 1</a>--}}
{{--                                        <a class="dropdown-item" href="#">Option 2</a>--}}
{{--                                        <a class="dropdown-item" href="#">Option 3</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modals-slide-in">--}}
{{--                                    <span>Add New User</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr class="text-center">
                            <th style="width: 5%;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll">
                                    <label class="form-check-label" for="checkboxSelectAll"></label>
                                </div>
                            </th>
                            <th style="width: 11%;">Nama</th>
                            <th>Deskripsi</th>
{{--                            <th>Model</th>--}}
                            <th>Event</th>
{{--                            <th style="width: 8%;">Penyebab</th>--}}
                            <th>Tanggal Buat</th>
                            <th style="width: 15%;">Di Buat Oleh</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($logs as $log)
                            <tr class="text-center">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll">
                                        <label class="form-check-label" for="checkboxSelectAll"></label>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $log->log_name }}</span>
                                </td>
                                <td>{{ $log->description }}</td>
                                <td>
                                    <span class="badge rounded-pill badge-light-danger">
                                        {{  $log->event }}
                                    </span>
                                </td>
                                <td>
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                     <span class="badge rounded-pill badge-light-info">
                                       {{ Auth::user()->name }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-danger text-center">Maaf, data tidak ditemukan</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Start -->
                <x-pagination :datalinks="$logs" :page="$page" :total-data="$totalData"
                              :page-count="$pageCount"/>
                <!-- Pagination end -->
            </div>
        </div>
    </div>
</div>
