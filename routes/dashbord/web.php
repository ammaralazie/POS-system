<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
   Route::prefix('dashbord')->name('dashbord.')->middleware('auth')->group(function(){

        Route::get('/check',function(){
           return view('dashbord.index');
       })->name('index');//end rout check


       //route user
        Route::resource('users','UserController')->except(['show']);

        //route categories
        Route::resource('categories','CategoryController')->except(['show']);

        //route products
        Route::resource('products','ProductCotroller')->except(['show']);

        //route clintes
        Route::resource('clients','ClientController')->except(['show']);

    });

});
