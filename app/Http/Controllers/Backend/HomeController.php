<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view ('backend.pages.home');
    }

    public function login()
    {
        return view ('backend.pages.login');
    }

    public function dologin(Request $request)
    {
        $validate=Validator::make($request-> all(),[
            'email'=>'required',
            'password'=>'required | min:5'
        ]);

        if ($validate->fails())
        {
           return redirect()->back();
        }

        $credentials=$request->only(['email','password']);
        
        if (auth()->attempt($credentials)){

            return redirect()->route('home');
             }
             return redirect()->back();
    }
}
