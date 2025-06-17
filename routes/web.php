<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\InvalidAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('layouts.admin.index');
})->middleware(InvalidAuth::class)->name('index');


Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register/store', [HomeController::class, 'register_store'])->name('register.store');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login/store', [HomeController::class, 'login_store'])->name('login.store');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// category
Route::get('/category', [CategoryController::class, 'category'])->name('category')->middleware(InvalidAuth::class);
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');


// imageUpload
Route::post('/upload-image', [HomeController::class, 'upload_image']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::post('/upload-image', function (Request $request) {
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = uniqid() . '-' . $file->getClientOriginalName();

        // Save to public/uploads
        $file->move(public_path('uploads'), $filename);

        // Return the public URL
        return response()->json(['location' => asset('uploads/' . $filename)]);
    }

    return response()->json(['error' => 'No file uploaded.'], 400);
});

require __DIR__.'/auth.php';
