<div class="bg-image" style="background-image: url('/assets/media/photos/photo19@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full content-top">
            <div class="d-flex justify-content-between align-items-center" style="height: 70px">
                <h1 class="font-size-h2 text-white mb-0">
                    {{ $title }} @if($subtitle)<div class="font-size-lg text-white-75">{{ $subtitle }}</div>@endif
                </h1>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
