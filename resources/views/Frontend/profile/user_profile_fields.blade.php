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
                        <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="text-center">
                            <div class="text-danger">Hello <strong>{{ Auth::user()->name }}</strong> Update your profile</div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('update.fields') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Name </label>
                                    <input type="text" name="name" class="form-control unicase-form-control text-input"
                                        id="name" value="{{ $user->name }}" />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email </label>
                                    <input type="email" name="email" class="form-control unicase-form-control text-input"
                                        id="email" value="{{ $user->email }}" />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Phone </label>
                                    <input type="phone" name="phone" class="form-control unicase-form-control text-input"
                                        id="phone" value="{{ $user->phone }}" />
                                    
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Profile Image </label>
                                    <input type="file" name="profile_photo_path" class="form-control unicase-form-control text-input"
                                        id="phone" />
                                    
                                </div>

                                <button type="submit" class="btn btn-primary" style="margin-bottom:20px">Update Profile</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
