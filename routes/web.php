<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
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


Route::get('/admin/login', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class,'profile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'edit'])->name('admin-profile-edit');
Route::post('/admin/profile/store',[AdminProfileController::class,'store'])->name('admin.profile.store');
Route::get('admin/change/password',[AdminProfileController::class,'changepassword'])->name('admin.changepassword');
Route::post('admin/change/password/trigger',[AdminProfileController::class,'addupdatedpassword'])->name('update.admin.change.password');

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

});
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


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
