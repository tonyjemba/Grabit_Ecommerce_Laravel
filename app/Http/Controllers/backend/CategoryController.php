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
}
