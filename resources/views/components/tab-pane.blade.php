<div x-show="tab == '#{{ $id }}'" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $id }}-tab" {{ $attributes->class(['content' => $wrapper]) }}>
    {{ $slot }}
</div>