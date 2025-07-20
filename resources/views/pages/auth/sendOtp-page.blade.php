@extends('layout.app')
<!-- title -->
@section('title','OTP')
@section('contant')
    <section class="bg-body-secondary vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 d-md-block d-none">
                    <img src="{{url('images/login.png')}}" class="img-fluid" alt="login-image">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-11">
                    <h4 class="fw-semibold poppins-medium text-capitalize mb-4 text-end">Forgot your Password</h5>
                    <!-- login form -->    
                    @include('component.auth.OtpForm')
                </div>
            </div>
        </div>
    </section>
@endsection