<ul class="nav navbar-nav">
    <li class="nav-item d-none d-lg-block">
        <a wire:click.prevent="toggleDarkMode" class="nav-link nav-link-style" wire:ignore>
            <i class="ficon" data-feather="{{ $configData['theme'] }}"></i>
        </a>
    </li>
</ul>
