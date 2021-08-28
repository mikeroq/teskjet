@extends('layouts.app')

@section('title', $customer->name . ' - Viewing Customer')

    <livewire:customer.show-customer :customer="$customer">
