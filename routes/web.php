<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;

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



//admin

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

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

//users
Route::get('/',[IndexController::class,'index']);
// Route::get('users/login/form', [UserController::class,'create']);
// Route::post('/user/login',[UserController::class,'login'])->name('user.login');





Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
