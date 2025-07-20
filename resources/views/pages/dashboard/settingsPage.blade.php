@extends('layout.sideNav')
@section('title','Setting')
@section('contant')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="card card-body shadow-sm mt-5">
                        <h4 class="text-capitalize">update your password</h4>
                        <hr>
                        @include('component.dashboard.settingsForm')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection