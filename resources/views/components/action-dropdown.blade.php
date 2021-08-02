<nav class="flex-sm-00-auto ml-sm-3">
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" id="{{ $id }}"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars"></i>
            <span class="d-none d-sm-inline-block">{{ $buttonName }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-dark dropdown-menu-right" aria-labelledby="{{ $id }}">
            {{ $slot }}
        </div>
    </div>
</nav>