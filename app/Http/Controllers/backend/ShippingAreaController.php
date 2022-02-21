<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function DivisionView(){
		$divisions = ShipDivision::orderBy('id','DESC')->get();
		return view('backend.ship.division.view_division',compact('divisions'));

	}
}
