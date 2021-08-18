@extends('layouts.backend')

@section('title', 'Permissions Admin')
@section('content')
    <x-page-header title="Permission Management" subtitle="Admin Panel">
        <x-action-dropdown id="role_action_dropdown">
            <button class="dropdown-item" onclick="Livewire.emit('openModal', 'admin.modals.create-permission')">
                <i class="fas fa-plus me-1 fa-fw"></i>
                Add Permission
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.permission-table />
        </x-block>
    </div>
@endsection