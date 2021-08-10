@error($id)
@php
$error = ' is-invalid';
@endphp
@enderror
@if($wrapper !== 'false')
<div class="mb-4">
@endif
    @if($label)
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" {!! $attributes->merge(['class' => 'form-control form-control-alt'.$error]) !!} id="{{ $id }}">
    @error($id) <div class="invalid-feedback">{{ $message }}</div> @enderror
@if($wrapper !== 'false')
</div>
@endif