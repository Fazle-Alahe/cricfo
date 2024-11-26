<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        $categories = Category::all();
        $n_categories = Category::whereNull('category_id')->with('childrenCategories')->get();
        return view('admin.category.add_category',[
            'categories' => $categories,
            'n_categories' => $n_categories,
        ]);
    }

    public function category_store(Request $request){
        $request->validate([
            'category_name' => 'required | unique:categories,category_name',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category added successfully.');
    }
}
