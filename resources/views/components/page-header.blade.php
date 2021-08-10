<!--suppress ALL -->
<div style="background-image: url('/assets/media/photos/photo19@2x.jpg');" {{ $attributes->merge(['class' => 'bg-image']) }}>
    <div class="bg-primary-dark-op">
        <div class="content content-full bg-black-50">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="flex-fill text-white my-2">
                        {{ $title }} @if($subtitle)
                            <span class="fs-lg text-muted">
                        {{ $subtitle }}
                        </span>
                        @endif
                    </h2>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>