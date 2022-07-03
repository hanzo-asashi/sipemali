<div class="col-xl-8 col-md-6 col-12" wire.poll.keep-alive>
  <div class="card card-statistics">
    <div class="card-header">
      <h4 class="card-title">Statistics</h4>
      <div class="d-flex align-items-center">
        <p class="card-text font-small-2 me-25 mb-0">Data update : {{ $updatedDate }}</p>
      </div>
    </div>
    <div class="card-body statistics-body">
      <div class="row">
        @foreach($tipe as $t)
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="d-flex flex-row">
              <div class="avatar bg-light-{{ $t['bg'] }} me-2">
                <div class="avatar-content">
                  <i data-feather="{{ $t['icon'] }}" class="avatar-icon"></i>
                </div>
              </div>
              <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ $t['count'] }}</h4>
                <p class="card-text font-small-3 mb-0">{{ $t['name'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
