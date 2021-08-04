@extends('layouts.backend')

@section('title', 'Device Types Admin')
@section('content')
    <x-page-header title="Device Type Management" subtitle="Admin Panel"></x-page-header>
    <div class="content p-0">
        <div class="block block-themed block-transparent bg-black-25 mb-0">
            <div class="block-content text-gray pb-3">
                <livewire:admin.device-type-table />
            </div>
        </div>
    </div>
@endsection
@push('modal')
<x-form-modal type="create" slug="devicetype" title="Create Device Type" icon="far fa-registered" btn="Add Device Type">
    <div class="form-group">
        <label for="devicetype_name">Name</label>
        <input type="text" class="form-control" id="devicetype_name" name="devicetype_name" placeholder="Enter Device Type" required>
    </div>
</x-form-modal>
<x-form-modal type="edit" slug="devicetype" title="Edit Device Type" icon="fas fa-pencil-alt" btn="Edit Customer">
    <div class="form-group">
        <label for="devicetype_name">Name</label>
        <input type="text" class="form-control" id="edit_devicetype_name" name="edit_devicetype_name" placeholder="Enter Device Type" required>
    </div>
</x-form-modal>
@endpush