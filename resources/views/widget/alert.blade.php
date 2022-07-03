<!-- alert start -->
@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <strong>Sukses!!</strong>
            {{ session('message') }}
        </div>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <strong>Kesalahan!!</strong>
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
        <i class="mdi mdi-check-all label-icon"></i><strong>Sukses</strong> - {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
        <i class="mdi mdi-check-all label-icon"></i><strong>Kesalahan</strong> - {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<!-- alert end -->
