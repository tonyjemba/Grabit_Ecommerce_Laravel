@extends('Frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img class="img-card-top " height="100%" width="100%" style=" border-radius:50%"  src="{{ !empty(Auth::user()->profile_photo_path)? url('upload/user_images/'.Auth::user()->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar">
                <br>
                <ul class="list-group list-group-flush">
                    <a href="" class="btn btn-primary btn-sm btn-block " style="margin-top:20px">Home</a>
                    <a href="{{ route('profile.update') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route( "change.password") }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                        <div class="text-danger">Hello <strong>{{ Auth::user()->name }}</strong> Welcome to the Grabit Ecommerce</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

