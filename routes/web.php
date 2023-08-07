<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Backend\UserController;



Route::get('/',[WebsiteController::class,'webhome'])->name('website');
Route::post('/reg-store',[WebsiteController::class,'regstore'])->name('regstore');
Route::post('/web-login',[WebsiteController::class,'weblogin'])->name('weblogin');


Route::group(['prefix'=>'admin'],function(){

    Route::get('/login', [HomeController::class,'login'])->name('login');
    Route::post('/do-login',[HomeController::class,'dologin'])->name('do.login');


        Route::group(['middleware'=>'auth'],function(){

          //for home
          Route::get('/', [HomeController::class,'home'])->name('home');
          //for admin
          Route::get('/list',[UserController::class,'adminlist'])->name('admin.list');
          Route::get('/form',[UserController::class,'adminform'])->name('admin.form');
          Route::post('/store',[UserController::class,'adminstore'])->name('admin.store');

          //for customer
          Route::get('/customer/list',[UserController::class,'customerlist'])->name('customer.list');
          Route::get('/sendmail/{id}',[UserController::class,'sendmail'])->name('sendmail');
          
       });

           
          
});
   
        
     
            

  


       


     

      
        




         
       

         

           