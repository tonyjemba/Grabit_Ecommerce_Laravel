<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function catview(){

        $categories = Category::latest()->get();
        return view('backend.category.category_view',compact('categories'));

    }

    public function AddCat(Request $request){
        $request->validate([
    		'category_name_en' => 'required',
    		'category_name_hin' => 'required',
    		'category_icon' => 'required',
    	],[
    		'category_name_en.required' => 'Input Category English Name',
    		'category_name_hin.required' => 'Input Category Hindi Name',
    	]);

    	 

	Category::insert([
		'category_name_en' => $request->category_name_en,
		'category_name_hin' => $request->category_name_hin,
		'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
		'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
		'category_icon' => $request->category_icon,

    	]);

	    $notification = array(
			'message' => 'Category Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);    }

        public function CategoryEdit($id){
            $category = Category::findOrFail($id);
            return view('backend.category.category_edit',compact('category'));
    
        }
        public function CategoryUpdate(Request $request ,$id){

    	 

            Category::findOrFail($id)->update([
              'category_name_en' => $request->category_name_en,
              'category_name_hin' => $request->category_name_hin,
              'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
              'category_slug_hin' => str_replace(' ', '-',$request->category_name_hin),
              'category_icon' => $request->category_icon,
      
              ]);
      
              $notification = array(
                  'message' => 'Category Updated Successfully',
                  'alert-type' => 'success'
              );
      
              return redirect()->route('view.category')->with($notification);
      
      
          }

          public function CategoryDelete($id){

            Category::findOrFail($id)->delete();
    
            $notification = array(
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    
        }
}
