<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    @if($label)
        <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    {{ $slot }}
</div>