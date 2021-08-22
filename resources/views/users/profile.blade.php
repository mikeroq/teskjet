@extends('layouts.backend')

@section('title', $user->name . ' - User Profile')
@section('content')
    <livewire:user.profile :user="$user"/>
@endsection