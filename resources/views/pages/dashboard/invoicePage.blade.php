@extends('layout.sideNav')
@section('title','Invoice')
@section('contant')
    @include('component.invoice.InvoiceListPage')
    @include('component.invoice.InvoiceDetailPage')
    @include('component.invoice.InvoiceDeletePage')
@endsection