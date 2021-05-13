<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
   Route::prefix('dashbord')->name('dashbord.')->middleware('auth')->group(function(){

        //main page route
        Route::get('/', 'WelcomeController@index')->name('index');

       //route user
        Route::resource('users','UserController')->except(['show']);

        //route categories
        Route::resource('categories','CategoryController')->except(['show']);

        //route clintes
        Route::resource('clients','ClientController')->except(['show']);
        Route::resource('clients.orders','Client\ClientController')->except(['show']);

        //route products
        Route::resource('products','ProductCotroller')->except(['show']);

        //route orders
        Route::resource('orders','OrderController');
        Route::get('orders/{order}/products','OrderController@products')->name('orders.products');

    });

});
