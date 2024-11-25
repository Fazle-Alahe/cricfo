<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        return view('admin.category.add_category');
    }

    public function category_store(Request $request){
        $request->validate([
            'category_name' => 'required | unique:categories,category_name',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'parent_id' => $request->category_id,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category added successfully.');
    }
}
