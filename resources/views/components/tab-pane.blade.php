<div x-show="tab == '#{{ $id }}'" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $id }}-tab">
    {{ $slot }}
</div>