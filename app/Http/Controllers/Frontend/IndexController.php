<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        return view('Frontend.index');
    }
    public function userLogout(){
        Auth::logout();

        return Redirect()->route('login');
    }
    public function userprofilefields(){
        $loggedinUserId = Auth::user()->id;

        $user = User::find($loggedinUserId);

        return view('Frontend.profile.user_profile_fields',compact('user'));
    }
    public function update(Request $request){

        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            // @unlink(public_path('upload/admin_images'));
            $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$filename);

            $data->profile_photo_path = $filename;

        }
        $data->save();

        $notification = array(
            'message' => "Profile updated successfully",
            'alert-type' => "success"
        );

        return Redirect()->route('dashboard');



    }
}
