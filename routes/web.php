<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//admin backend

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login/form', [AdminController::class, 'loginForm'])->name('admin.login.form');
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

//protecting admin routes
Route::middleware(['auth:admin'])->group(function(){

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

Route::get('/admin/login', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class,'profile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'edit'])->name('admin-profile-edit');
Route::post('/admin/profile/store',[AdminProfileController::class,'store'])->name('admin.profile.store');
Route::get('admin/change/password',[AdminProfileController::class,'changepassword'])->name('admin.changepassword');
Route::post('admin/change/password/trigger',[AdminProfileController::class,'addupdatedpassword'])->name('update.admin.change.password');


});
//admin All Brands routes
Route::prefix('brand')->group(function(){
    Route::get("/view",[BrandController::class,"brandview" ])->name('all.brand');
    Route::post("/add",[BrandController::class,"AddBrand"])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post("/update",[BrandController::class,"brandUpdate"])->name('brand.update');
    Route::get("/delete/{id}",[BrandController::class,"delete"])->name('brand.delete');
});

//admin All category routes
Route::prefix('category')->group(function(){
    Route::get("/view",[CategoryController::class,"catview" ])->name('view.category');
    Route::post("/add",[CategoryController::class,"AddCat"])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    // Admin Sub Category All Routes

Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');


// Admin Sub->Sub Category All Routes

Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);

Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

Route::post('/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

});

// Admin Products All Routes 

Route::prefix('product')->group(function(){

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
    
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
     
    });

    

// Admin Slider All Routes 

Route::prefix('slider')->group(function(){

    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    
    });
    



//users frontend
Route::get('/',[IndexController::class,'index']);
Route::get("user/logout",[IndexController::class,'userLogout'])->name('user.logout');
Route::get("user/profile/update",[IndexController::class,'userprofilefields'])->name('profile.update');
Route::post("user/profile/make/update",[IndexController::class,'update'])->name('update.fields');
Route::get("user/change/password",[IndexController::class,"changepassword"])->name('change.password');
Route::post("user/change/passwordfield",[IndexController::class,"updatepassword"])->name('user.change.password');





Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Frontend all routes

/// Multi Language All Routes ////

Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

// Frontend Product Details Page url 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Frontend Product Tags Page 
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Frontend Sub-SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);


// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);