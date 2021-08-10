@error($id)
@php
    $error = ' is-invalid';
@endphp
@enderror
<div class="form-check">
    <input {!! $attributes->merge(['class' => 'form-check-input'.$error]) !!} type="checkbox" id="{{ $id }}">
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @error($id) <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>