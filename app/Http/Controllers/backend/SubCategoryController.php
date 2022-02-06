<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
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

	public function SubCategoryDelete($id){

		SubCategory::findOrFail($id)->delete();
    
		$notification = array(
			'message' => 'subcategory Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

	}

	///sub sub categories methods

	public function SubSubCategoryView(){

		
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
    	$subsubcategory = SubSubCategory::latest()->get();
    	return view('backend.category.subsubcategory_view',compact('subsubcategory','categories'));
	}

	public function GetSubCategory($category_id){

		$subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
		return json_encode($subcat);

	}

	public function SubSubCategoryStore(Request $request){
		$request->validate([
    		'category_id' => 'required',
    		'subcategory_id' => 'required',
    		'subsubcategory_name_en' => 'required',
    		'subsubcategory_name_hin' => 'required',
    	],[
    		'category_id.required' => 'Please select Any option',
    		'subsubcategory_name_en.required' => 'Input SubSubCategory English Name',
    	]);

    	 

	   SubSubCategory::insert([
		'category_id' => $request->category_id,
		'subcategory_id' => $request->subcategory_id,
		'subsubcategory_name_en' => $request->subsubcategory_name_en,
		'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
		'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
		'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),
		 

    	]);

	    $notification = array(
			'message' => 'Sub-SubCategory Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	}
}
