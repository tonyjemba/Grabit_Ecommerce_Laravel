<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhishListController extends Controller
{
    public function ViewWishlist(){
		return view('frontend.wishlist.view_wishlist');
	}
}
