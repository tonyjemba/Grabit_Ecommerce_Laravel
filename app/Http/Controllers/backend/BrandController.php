<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class BrandController extends Controller
{
    public function brandview(){
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_view',compact('brands'));
    }

    public function AddBrand (Request $request){
      
    	$request->validate([
    		'brand_name_en' => 'required',
    		'brand_name_hin' => 'required',
    		'brand_image' => 'required',
    	],[
    		'brand_name_en.required' => 'Input Brand English Name',
    		'brand_name_hin.required' => 'Input Brand Hindi Name',
    	]);

    	$image = $request->file('brand_image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(300,300)->save('upload/brand_images/'.$name_gen);
    	$save_url = 'upload/brand_images/'.$name_gen;

	Brand::insert([
		'brand_name_en' => $request->brand_name_en,
		'brand_name_hin' => $request->brand_name_hin,
		'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
		'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),
		'brand_image' => $save_url,

    	]);

	    $notification = array(
			'message' => 'Brand Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);    
    }

    public function BrandEdit($id){
         $brand= Brand::findOrFail($id);

         return view('backend.brand.brand_edit',compact('brand'));
    }


    public function brandUpdate(Request $request){
        $brand_id = $request->id;
    	$old_img = $request->old_image;

    	if ($request->file('brand_image')) {

    	unlink($old_img);
    	$image = $request->file('brand_image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(300,300)->save('upload/brand_images/'.$name_gen);
    	$save_url = 'upload/brand_images/'.$name_gen;

	Brand::findOrFail($brand_id)->update([
		'brand_name_en' => $request->brand_name_en,
		'brand_name_hin' => $request->brand_name_hin,
		'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
		'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),
		'brand_image' => $save_url,

    	]);

	    $notification = array(
			'message' => 'Brand Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.brand')->with($notification);

    	}else{

    	Brand::findOrFail($brand_id)->update([
		'brand_name_en' => $request->brand_name_en,
		'brand_name_hin' => $request->brand_name_hin,
		'brand_slug_en' => strtolower(str_replace(' ', '-',$request->brand_name_en)),
		'brand_slug_hin' => str_replace(' ', '-',$request->brand_name_hin),
		 

    	]);

	    $notification = array(
			'message' => 'Brand Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.brand')->with($notification);

    	} // end else 
    }

	public function delete($id){

		$brand = Brand::findOrFail($id);
		$image = $brand->brand_image;
		unlink($image);

		$brand->delete();

		$notification = ([
			'message' => 'Brand deleted successfully',
			'alert-type' => 'info'
		]);

		return Redirect()->back()->with($notification);
	}
}
