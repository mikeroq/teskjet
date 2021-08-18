@extends('layouts.backend')

@section('title', 'Device Types Admin')
@section('content')
    <x-page-header title="Device Type Management" subtitle="Admin Panel">
        <x-action-dropdown id="device_types_action_dropdown">
            <button class="dropdown-item" onclick="Livewire.emit('openModal', 'admin.modals.create-device-type')">
                <i class="fas fa-plus me-1 fa-fw"></i>
                Add Device Type
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.device-type-table/>
        </x-block>
    </div>
@endsection