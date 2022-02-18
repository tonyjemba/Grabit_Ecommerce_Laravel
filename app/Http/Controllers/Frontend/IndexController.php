<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        // $blogpost = BlogPost::latest()->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        //returns the first 6 featured products
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();

        //returns the first 3 hot deals products
        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();

        //...
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        //geting specific category content
        $skip_category_0 = Category::skip(0)->first();
        //geting all products in that category
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();

        //geting products of a specific brand
        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status', 1)->where('brand_id', $skip_brand_1->id)->orderBy('id', 'DESC')->get();


        return view('Frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hot_deals', 'special_offer', 'special_deals', 'skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_brand_1', 'skip_brand_product_1'));
    }
    public function userLogout()
    {
        Auth::logout();

        return Redirect()->route('login');
    }
    public function userprofilefields()
    {
        $loggedinUserId = Auth::user()->id;

        $user = User::find($loggedinUserId);

        return view('Frontend.profile.user_profile_fields', compact('user'));
    }
    public function update(Request $request)
    {

        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            // @unlink(public_path('upload/admin_images'));
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);

            $data->profile_photo_path = $filename;
        }
        $data->save();

        $notification = array(
            'message' => "Profile updated successfully",
            'alert-type' => "success"
        );

        return Redirect()->route('dashboard');
    }

    public function changepassword()
    {
        $loggedinUserId = Auth::user()->id;

        $user = User::find($loggedinUserId);
        return view('Frontend.profile.change_password', compact('user'));
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            "oldpassword" => 'required',
            "password" => 'required|confirmed'
        ]);

        $hashed_old_password = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashed_old_password)) {

            $user = User::find(Auth::user()->id);

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('user.logout');
        }

        return Redirect()->back();
    }

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',', $color_hin);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',', $size_hin);

        $multiImag = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact('product', 'multiImag', 'product_color_en', 'product_color_hin', 'product_size_en', 'product_size_hin', 'relatedProduct'));
    }

    public function TagWiseProduct($tag){
		$products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_hin',$tag)->orderBy('id','DESC')->paginate(3);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tags.tags_view',compact('products','categories'));

	}

    public function SubCatWiseProduct(Request $request, $subcat_id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
		$categories = Category::orderBy('category_name_en','ASC')->get();

		$breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();


		///  Load More Product with Ajax 
		if ($request->ajax()) {
   $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();

   $list_view = view('frontend.product.list_view_product',compact('products'))->render();
	return response()->json(['grid_view' => $grid_view,'list_view',$list_view]);	

		}
		///  End Load More Product with Ajax 

		return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat'));
    }
}
