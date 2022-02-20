<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishListController extends Controller
{
    public function ViewWishlist(){
		return view('frontend.wishlist.view_wishlist');
	}

    public function GetWishlistProduct(){

		$wishlist = Whishlist::with('product')->where('user_id',Auth::id())->latest()->get();
		return response()->json($wishlist);
	}
}
