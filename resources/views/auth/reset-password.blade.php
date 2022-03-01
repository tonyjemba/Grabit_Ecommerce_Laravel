
@extends('Frontend.main_master')

@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Reset password Password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Reset password</h4>
                        <p class="">Register new password </p>
                   
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email"
                                    name="email" />
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Password<span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" id="password"
                                    name="password" />
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation"
                                    name="password_confirmation" />
                            </div>
                            
                            
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">
                                Change password
                            </button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.sigin-in-->
           @include('Frontend.Body.brand')
            <!-- /.logo-slider -->
           </div>
        <!-- /.container -->
    </div>

@endsection


