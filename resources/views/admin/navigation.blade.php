@extends('layouts.backend')

@section('title', 'Navigation Admin')
@section('content')
    <x-page-header title="Navigation Management" subtitle="Admin Panel"></x-page-header>
    <div class="content mb-0 p-0">
        <ul class="nav nav-tabs nav-tabs-alt" id="tabs" role="tablist">
            @foreach ($navigation_types as $type)
                <li class="nav-item">
                    <button class="nav-link @if($loop->first) active @endif" role="tab"
                            aria-controls="{{ $type->slug }}" data-bs-toggle="tab" data-bs-target="#{{ $type->slug }}"
                            id="{{ $type->slug }}_tab"
                            onclick="Livewire.emit('navTab', '{{ $type->id }}')">{{ $type->name }}</button>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="content tab-content">
        <livewire:admin.navigation-table/>
    </div>
@endsection