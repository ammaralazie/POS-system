<?php

use App\Http\Controllers\Dashbord\UserController;
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
   Route::prefix('dashbord')->name('dashbord.')->middleware('auth')->group(function(){

        Route::get('/check',function(){
           return view('dashbord.index');
       })->name('index');//end rout check

        Route::resource('users','UserController')->except(['show']);

    });

});
