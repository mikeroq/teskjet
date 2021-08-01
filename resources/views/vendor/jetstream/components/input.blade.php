@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control bg-black-10 text-gray-lighter border-dark']) !!}>
