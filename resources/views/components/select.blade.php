@error($id)
@php
    $error = ' is-invalid';
@endphp
@enderror
<div class="mb-4">
    @if($label)
        <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <select id="{{ $id }}" {!! $attributes->merge(['class' => 'form-select form-select-alt'.$error]) !!}>
        {{ $slot }}
    </select>
    @error($id) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>