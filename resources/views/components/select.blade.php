@if($label)
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
@endif
<select id="{{ $id }}" {!! $attributes->merge(['class' => 'form-select']) !!}>
    {{ $slot }}
</select>