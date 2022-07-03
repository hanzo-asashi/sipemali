@extends('layouts.contentLayoutMaster')
@section('title', 'Laporan Penerimaan Penagihan Custom')
@section('breadcrumbs')
    @if(isset($breadcrumbs))
        <x-breadcrumb :breadcrumbs="[]"/>
    @endif
@endsection
@section('header-right')

@endsection
@push('vendor-style')

@endpush

@section('content')
    <livewire:laporan.form-penerimaan-penagihan />
@endsection
