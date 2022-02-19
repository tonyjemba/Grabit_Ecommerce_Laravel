<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){

        if (Session::has('coupon')) {
          Session::forget('coupon');
       }
         
       $product = Product::findOrFail($id);

       if ($product->discount_price == NULL) {
           Cart::add([
               'id' => $id, 
               'name' => $request->product_name, 
               'qty' => $request->quantity, 
               'price' => $product->selling_price,
               'weight' => 1, 
               'options' => [
                   'image' => $product->product_thambnail,
                   'color' => $request->color,
                   'size' => $request->size,
               ], 
           ]);

           return response()->json(['success' => 'Successfully Added on Your Cart']);
            
       }else{

           Cart::add([
               'id' => $id, 
               'name' => $request->product_name, 
               'qty' => $request->quantity, 
               'price' => $product->discount_price,
               'weight' => 1, 
               'options' => [
                   'image' => $product->product_thambnail,
                   'color' => $request->color,
                   'size' => $request->size,
               ],
           ]);
           return response()->json(['success' => 'Successfully Added on Your Cart']);
       }

   }

   //add cart data to the mini cart in the header

   public function AddMiniCart(){

    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();

    return response()->json(array(
        'carts' => $carts,
        'cartQty' => $cartQty,
        'cartTotal' => $cartTotal,

    ));
}

public function RemoveMiniCart($rowId){
    Cart::remove($rowId);
    return response()->json(['success' => 'Product Remove from Cart']);

}

public function AddToWishlist(Request $request, $product_id){

    if (Auth::check()) {

        $exists = Whishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

        if (!$exists) {
           Whishlist::insert([
            'user_id' => Auth::id(), 
            'product_id' => $product_id, 
            'created_at' => Carbon::now(), 
        ]);
       return response()->json(['success' => 'Successfully Added On Your Wishlist']);

        }else{

            return response()->json(['error' => 'This Product has Already on Your Wishlist']);

        }            
        
    }else{

        return response()->json(['error' => 'At First Login Your Account']);

    }

}
}
