@extends('layouts.backend')

@section('title', 'Device Types Admin')
@section('content')
    <x-page-header title="Device Type Management" subtitle="Admin Panel"></x-page-header>
    <div class="content p-0">
        <x-block class="pb-3">
            <livewire:admin.device-type-table />
        </x-block>
    </div>
@endsection