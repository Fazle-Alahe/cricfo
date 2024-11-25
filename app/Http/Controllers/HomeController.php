<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

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

        if(User::where('email', $re)){
            return back()->with('wrong', "Password doesn't match!");
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
}
