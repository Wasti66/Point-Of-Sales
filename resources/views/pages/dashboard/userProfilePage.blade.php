@extends('layout.sideNav')
@section('title','User-Profile')
@section('contant')
    <section>
        <div class="container">
            <div class="row justify-content-center  mt-5">
                <div class="col-lg-4">
                    <h4 class="text-capitalize poppins-medium mb-md-0 mb-3">update your profile</h4>
                </div>
                <div class="col-md-8">
                    <div class="card card-body shadow-sm">
                        @include('component.dashboard.userProfileForm')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection