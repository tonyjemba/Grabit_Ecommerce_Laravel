<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function login(Request $request){

       $user = User::where('email', $request->email)->first();

       if ($user &&
       Hash::check($request->password, $user->password)) {
       return Redirect()->route('dashboard');
   }else{
       return Redirect()->back();
   }

    }
}
