@extends('layouts.backend')

@section('title', 'Roles Admin')
@section('content')
    <x-page-header title="Role Management" subtitle="Admin Panel">
        <x-action-dropdown id="role_action_dropdown">
            <button class="dropdown-item" onclick="Livewire.emit('openModal', 'admin.modals.create-role')">
                <i class="fas fa-plus me-1 fa-fw"></i>
                Add Role
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.role-table />
        </x-block>
    </div>
@endsection