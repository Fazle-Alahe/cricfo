<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        $n_categories = Category::whereNull('category_id')->with('childrenCategories')->get();
        $desp = Category::find(28);
        return view('admin.category.add_category', [
            'categories' => $categories,
            'n_categories' => $n_categories,
            'desp' => $desp,
        ]);
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required | unique:categories,category_name',
            'icon' => 'nullable|string',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        //  $manager = new ImageManager(new GdDriver()); 
        $manager = new ImageManager(new ImagickDriver());
         $manager->read($image)->resize(300, 300)->save(public_path('uploads/category/' . $filename));
 
        Category::insert([
            'category_name' => $request->category_name,
            'category_id' => $request->category_id,
            'icon' => $filename,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        // dd(extension_loaded('imagick'));
        return back()->with('success', 'Category added successfully.');
    }
}
