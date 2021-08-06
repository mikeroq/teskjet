<div class="block block-themed">
    @if($title)
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">{{ $title }}</h3>
    </div>
    @endif
    <div {{ $attributes->merge(['class' => 'block-content']) }}>
        {{ $slot }}
    </div>
</div>