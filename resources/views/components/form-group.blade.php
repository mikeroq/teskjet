<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    {{ $slot }}
</div>