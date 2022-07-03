<!-- alert start -->
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <strong><i data-feather="check-circle"></i> Sukses - </strong>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <strong><i data-feather="info"></i> Kesalahan - </strong>
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<!-- alert end -->
