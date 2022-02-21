<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart(){
    	return view('frontend.wishlist.view_mycart');

    }

    public function GetCartProduct(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' =>$cartTotal,

    	));

    }

    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    // Cart Increment 
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

 

        return response()->json('increment');

    } // end mehtod 


   // Cart Decrement  
    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        return response()->json('Decrement');

    }

}
