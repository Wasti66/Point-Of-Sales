@extends('layout.sideNav')
@section('title','Category')
@section('contant')
    @include('component.category.categoryListPage')
    @include('component.category.categoryCreatePage')
    @include('component.category.categoryUpdatePage')
    @include('component.category.categoryDeletePage')
@endsection