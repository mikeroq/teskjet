@extends('layouts.backend')

@section('title', $role->name . ' - Viewing Role')
@section('content')
    <livewire:admin.roles.show-role :role="$role">
@endsection