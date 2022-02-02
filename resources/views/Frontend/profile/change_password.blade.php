@extends('Frontend.main_master')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-card-top " height="100%" width="100%" style=" border-radius:50%"
                        src="{{ !empty($user->profile_photo_path)? url('upload/user_images/' . $user->profile_photo_path): url('upload/no_image.jpg') }}"
                        alt="User Avatar">
                    <br>
                    <ul class="list-group list-group-flush">
                        <a href="" class="btn btn-primary btn-sm btn-block " style="margin-top:20px">Home</a>
                        <a href="{{ route('profile.update') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="text-center">
                            <div class="text-danger"> Change  Password</div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.change.password') }}" >
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Currrent password </label>
                                    <input type="password" name="oldpassword" class="form-control unicase-form-control text-input"
                                        id="oldpassword"  />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Current Password </label>
                                    <input type="password" name="password" class="form-control unicase-form-control text-input"
                                        id="password"  />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Confirem Password</label>
                                    <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input"
                                        id="password_confirmation"  />
                                    
                                </div>
                            

                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px">Change Password</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
