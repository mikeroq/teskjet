@extends('layouts.backend')

@section('title', $customer->name . ' - Viewing Customer')
@section('content')
    <livewire:customer.show-customer :customer="$customer">
@endsection