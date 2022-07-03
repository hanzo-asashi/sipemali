<div class="dropdown d-none d-sm-inline-block">
    <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        @switch(Session::get('lang'))
            @case('en')
            <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
            @break
            @default
            <img src="{{ URL::asset('/assets/images/flags/id.jpg') }}" alt="Header Language" height="16">
        @endswitch
    </button>
    <div class="dropdown-menu dropdown-menu-end">

        <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="en">
            <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                 height="12"> <span class="align-middle">English</span>
        </a>
        <!-- item-->
        <a href="{{ url('index/id') }}" class="dropdown-item notify-item language" data-lang="id">
            <img src="{{ URL::asset('/assets/images/flags/id.jpg') }}" alt="user-image" class="me-1"
                 height="12"> <span class="align-middle">Indonesia</span>
        </a>
    </div>
</div>
