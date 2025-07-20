@extends('layout.app')
<!-- title -->
@section('title','Registration')
@section('contant')
    <section class="bg-body-secondary pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 d-md-block d-none">
                    <img src="images/reg.png" class="img-fluid" alt="registration-image">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-11">
                    <h4 class="fw-semibold poppins-medium mb-4 text-end">Create a account</h5>
                    <!-- login form -->    
                    @include('component.auth.userRegistrationFrom')
                </div>
            </div>
        </div>
    </section>
@endsection

