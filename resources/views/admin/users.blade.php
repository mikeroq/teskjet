@extends('layouts.backend')

@section('title', 'User Admin')
@section('content')
	<x-page-header title="User Management" subtitle="Admin Panel"></x-page-header>
	<div class="content p-0">
        <x-block class="pb-3">
            <livewire:admin.user-table />
        </x-block>
    </div>
@endsection