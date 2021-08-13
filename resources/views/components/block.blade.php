<div {{ $attributes->merge(['class' => 'block block-themed']) }}>
    @if($title)
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">{{ $title }}</h3>
        {{ $options }}
    </div>
    @endif
    <div class="{{ $contentClass->implode(' ') }}">
        {{ $slot }}
    </div>
    @if($footer)
    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
        {{ $footer }}
    </div>
    @endif
</div>