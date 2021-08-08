@extends('layouts.backend')

@section('title', 'Brands Admin')
@section('content')
    <x-page-header title="Brands Management" subtitle="Admin Panel"></x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.brand-table />
        </x-block>
    </div>
@endsection