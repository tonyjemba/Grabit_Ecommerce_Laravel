<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class StripeController extends Controller
{
	public function StripeOrder(Request $request){
		\Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

	 
	$token = $_POST['stripeToken'];
	$charge = \Stripe\Charge::create([
	  'amount' =>100,
	  'currency' => 'usd',
	  'description' => 'Easy Online Store',
	  'source' => $token,
	  'metadata' => ['order_id' => uniqid()],
	]);

	dd($charge);
	}


}
