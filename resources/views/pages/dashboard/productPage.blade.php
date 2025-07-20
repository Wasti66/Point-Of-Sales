@extends('layout.sideNav')
@section('title','Product')
@section('contant')
    @include('component.product.productListpage')
    @include('component.product.productCreatePage')
    @include('component.product.productUpdatePage')
    @include('component.product.productDeletePage')
@endsection