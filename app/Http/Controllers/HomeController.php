<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function register(){
        return view('admin.register');
    }

    public function register_store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if(User::where('email', $request->email)->exists()){
            return back()->with('exists', "You have already an account!");
        }
        elseif($request->password != $request->confirm_password){
            return back()->with('wrong', "Password doesn't match!");
        }
        else{
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "You are registered successfully!!");
    }

    public function login(){
        if(Auth::check()){
            return redirect()->route('index');
        }
        else{
            return view('admin.login');
        }
    }

    public function login_store(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if(User::where('email', $request->email)->exists()){
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return redirect()->route('index')->with('logged', "You're logged in!!");
            }
            else{
                return back()->with('wrong', 'Wrong credential.');
            }
        }
        else{
            return back()->with('exists', 'Email does not exists.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    // imageUpload
    public function upload_image(Request $request){
        $request->validate([
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if ($request->hasFile('image')) {
            
            $file = $request->file('image');
            $fileName = uniqid() .random_int(50000, 60000) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category/'), $fileName);

            // $image = $request->image;
            // $extension = $image->extension();
            // $file_name = uniqid() .random_int(50000, 60000).'.'.$extension;
            // Image::make($image)->save(public_path('uploads/category/'.$file_name));
            // $file = $request->file('image');
            // $file_name = $file->getClientOriginalExtension();
            // $path = $file->store('images', 'public');
            // $filePath = $file->move(public_path('uploads/category/',$file_name));
            // $filePath = $file->move(public_path('uploads/category/'.$image));
    
            $previewPath = asset('uploads/category/' . $fileName);
    
            return response()->json([
                'success' => true,
                'filePath' => $fileName,
                'previewPath' => $previewPath,
            ]);
        }
    
    }
}
