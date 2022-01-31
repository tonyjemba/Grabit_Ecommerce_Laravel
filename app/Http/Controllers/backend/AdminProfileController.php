<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminProfileController extends Controller
{
    public function profile(){

        $adminData = Admin::find(1);

        return view('admin.admin_profile_view',compact('adminData'));
        
    }

    public function edit(){
        $adminData = Admin::find(1);

        return view('admin.admin_profile_edit',compact('adminData'));

    }

    public function addupdatedpassword(Request $request){
        $request->validate([
            "oldpassword"=> 'required',
            "password"=>'required|confirmed'
        ]);

        $hashed_old_password = Admin::find(1)->password;

        if(Hash::check($request->oldpassword,$hashed_old_password)){

            $admin = Admin::find(1);

            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return Redirect()->route('admin.logout');

        }

        return Redirect()->back();

    }

    public function changepassword(){
        return view('admin.change_password');
    }
    public function store(Request $request){

        $data = Admin::find(1);

        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images'));
            $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'),$filename);

            $data->profile_photo_path = $filename;

        }
        $data->save();

        return Redirect()->route('admin.profile');



    }

}
