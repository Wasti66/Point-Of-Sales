@extends('layout.sideNav')
@section('title','Customer')
@section('contant')
   @include('component.customer.customer-List-Page')
   @include('component.customer.customer-Create-Page')
   @include('component.customer.customer-Update-Page')
   @include('component.customer.customer-delete-Page')
@endsection
