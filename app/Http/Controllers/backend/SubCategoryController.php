<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
    	$subcategory = SubCategory::latest()->get();
    	return view('backend.category.subcategory_view',compact('subcategory','categories'));

    }

    public function SubCategoryStore(Request $request){
        $request->validate([
    		'subcategory_name_en' => 'required',
    		'subcategory_name_hin' => 'required',
    		'category_id' => 'required',
    	],[
    		'category_id.required' => 'Please select any option',
    		'subcategory_name_en.required' => 'Input Subcategory English Name',
    	]);

    	 

	SubCategory::insert([
        'category_id' => $request->category_id,
		'subcategory_name_en' => $request->subcategory_name_en,
		'subcategory_name_hin' => $request->subcategory_name_hin,
		'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
		'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),

    	]);

	    $notification = array(
			'message' => 'subcategory Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id){
         
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
           
    
            return view('backend.category.subcategory_edit',compact('categories','subcategory'));
    

    }

	public function SubCategoryUpdate(Request $request){

           $subcat_id = $request->id;

		SubCategory::findOrFail($subcat_id)->update([
			'subcategory_name_en' => $request->subcategory_name_en,
			'subcategory_name_hin' => $request->subcategory_name_hin,
			'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
			'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),
			'category_id' => $request->category_id,
	
			]);
	
			$notification = array(
				'message' => 'Subcategory Updated Successfully',
				'alert-type' => 'success'
			);
	
			return redirect()->route('view.category')->with($notification);
	

	}
}
