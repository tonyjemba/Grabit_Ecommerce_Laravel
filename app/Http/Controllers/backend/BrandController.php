<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brandview(){
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_view',compact('brands'));
    }

    public function AddBrand (Request $request){

    }
}
