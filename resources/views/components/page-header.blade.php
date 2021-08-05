<div class="bg-image" style="background-image: url('/assets/media/photos/photo19@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full bg-black-50">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        {{ $title }}
                    </h1>
                    @if($subtitle)
                        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        {{ $subtitle }}
                        </h2>
                    @endif
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>