<div class="dropdown">
    <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="{{ $id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bars"></i>
        {{ $buttonName }}
    </button>
    <div class="dropdown-menu dropdown-menu-right fs-sm" aria-labelledby="{{ $id }}">
        {{ $slot }}
    </div>
</div>