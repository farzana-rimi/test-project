<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddAdmin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function adminlist(){

        $admins=User::where('type','=','admin')->get();
        return view('backend.pages.admin.list',compact('admins'));
    }

    

    public function adminform(){
        $user=User::all();
        return view ('backend.pages.admin.form',compact('user'));
    }

    public function adminstore(Request $request ){
        
       $validate=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'contact'=>'required',
            'address'=>'required',
            'status'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        User::create([
             'first_name'=>$request-> first_name,
             'last_name'=>$request-> last_name,
             'contact'=>$request-> contact,
             'address'=>$request->address,
             'email'=>$request->email,
             'status'=>$request->status,
             'type'=>'admin',
             'password'=>bcrypt($request->password)
         ]);

         return redirect()->route('admin.list');
         
     }

     public function sendmail($id){
        $admins=User::find($id);
        Mail::to($admins->email)->send(new AddAdmin);
        return redirect()->back();
     }
 
     
     
    
 
     
 }
           


            
            



      
        
     
            


