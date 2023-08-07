<?php

namespace App\Http\Controllers\Frontend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function webhome(){
      
        return view('frontend.pages.webhome');
    }

    public function regstore(Request $request)
    {
      $validate=Validator::make($request->all(),[
         'first_name'=>'required',
         'last_name'=>'required',
         'customer_email'=>'required|unique:users,email',
         'password'=>'required',
         'contact'=>'required',
         'address'=>'required'
         
       
      ]);

      if($validate->fails())
      {
          
          return redirect()->back();
      }

      User::create([
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'email'=>$request->customer_email,
          'password'=>bcrypt($request->password),
          'contact'=>$request->contact,
          'address'=>$request->address,
          'type'=>'customer',
          'status'=>'active'
      ]);

      return redirect()->back();
    }


    public function weblogin(Request $request)
    {
        $validate=Validator::make($request->all(),[
           'email'=>'required',
           'password'=>'required'
        ]);

        if($validate->fails())
        {
            
            return redirect()->back();
        }

        $credentials=$request->except('_token');

        if(auth()->attempt($credentials)){

            return redirect()->route('website');
        }

       
          
    }
  
}

