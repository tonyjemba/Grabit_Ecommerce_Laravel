<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
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

public function CouponApply(Request $request){

    //the coupon has to be valid with a valid date
    $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
    if ($coupon) {

        Session::put('coupon',[
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round(floatval(Cart::total() * $coupon->coupon_discount/100)), 
            'total_amount' => round(floatval(Cart::total() - Cart::total() * $coupon->coupon_discount/100)) 
        ]);

        return response()->json(array(
            'validity' => true,
            'success' => 'Coupon Applied Successfully'
        ));
        
    }else{
        return response()->json(['error' => 'Invalid Coupon, Does not exist!']);
    }

}

public function CouponCalculation(){

    if (Session::has('coupon')) {
        return response()->json(array(
            'subtotal' => Cart::total(),
            'coupon_name' => session()->get('coupon')['coupon_name'],
            'coupon_discount' => session()->get('coupon')['coupon_discount'],
            'discount_amount' => session()->get('coupon')['discount_amount'],
            'total_amount' => session()->get('coupon')['total_amount'],
        ));
    }else{
        return response()->json(array(
            'total' => Cart::total(),
        ));

    }
}
}
