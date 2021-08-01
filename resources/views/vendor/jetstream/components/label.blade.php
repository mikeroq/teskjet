@props(['value'])

<label {{ $attributes->merge(['class' => 'text-gray']) }}>
    {{ $value ?? $slot }}
</label>
