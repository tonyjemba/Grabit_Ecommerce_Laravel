<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderMail;

class StripeController extends Controller
{

	
	public function StripeOrder(Request $request){
		\Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

		if ($request->session()->has('coupon')) {
    		$total_amount = $request->session()->get('coupon')['total_amount'];
    	}else{
    		$total_amount = Cart::total();
    	}
	$token = $_POST['stripeToken'];
	$charge = \Stripe\Charge::create([
	  'amount' =>$total_amount * 100,
	  'currency' => 'usd',
	  'description' => 'Grabit Ecommerce solutions',
	  'source' => $token,
	  'metadata' => ['order_id' => uniqid()],
	]);

	$order_id = Order::insertGetId([
		'user_id' => Auth::id(),
		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_id' => $request->state_id,
		'name' => $request->name,
		'email' => $request->email,
		'phone' => $request->phone,
		'post_code' => $request->post_code,
		'notes' => $request->notes,

		'payment_type' => 'Stripe',
		'payment_method' => 'Stripe',
		'payment_type' => $charge->payment_method,
		'transaction_id' => $charge->balance_transaction,
		'currency' => $charge->currency,
		'amount' => $total_amount,
		'order_number' => $charge->metadata->order_id,

		'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
		'order_date' => Carbon::now()->format('d F Y'),
		'order_month' => Carbon::now()->format('F'),
		'order_year' => Carbon::now()->format('Y'),
		'status' => 'pending',
		'created_at' => Carbon::now(),	 

	]);

	 //Start Send Email 
     $invoice = Order::findOrFail($order_id);
     	$data = [
     		'invoice_no' => $invoice->invoice_no,
     		'amount' => $total_amount,
     		'name' => $invoice->name,
     	    'email' => $invoice->email,
     	];

     	Mail::to($request->email)->send(new orderMail($data));

    // End Send Email 

	 //add the comoditied bought in the orderitem table in the db remove session an destroy cart return to dashbord
     $carts = Cart::content();
     foreach ($carts as $cart) {
     	OrderItem::insert([
     		'order_id' => $order_id, 
     		'product_id' => $cart->id,
     		'color' => $cart->options->color,
     		'size' => $cart->options->size,
     		'qty' => $cart->qty,
     		'price' => $cart->price,
     		'created_at' => Carbon::now(),

     	]);
     }


     if ($request->session()->has('coupon')) {
		$request->session()->forget('coupon');
     }

     Cart::destroy();

     $notification = array(
			'message' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);
	}


}
