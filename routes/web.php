<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::prefix('customer')->group(function(){   
//     Route::get('/','CustomerController@index')->name('customer.index');
//     Route::get('/get/all','CustomerController@getRow')->name('customer.get');
//     Route::put('/{id}','CustomerController@update')->name('customer.update');
//     Route::delete('/{id}','CustomerController@destroy')->name('customer.destroy');
// });


//Route::resource('/customer','CustomerController');
Route::prefix('customer')->group(function(){   
Route::get('/','CustomerController@index')->name('customer.index');
Route::post('/','CustomerController@store')->name('customer.store');

Route::get('/get/all','CustomerController@getRow')->name('customer.get');
Route::put('/{id}','CustomerController@update')->name('customer.update');
Route::delete('/{id}','CustomerController@destroy')->name('customer.destroy');

});


Route::prefix('category')->group(function(){
    // Route::get('/','Food\CategoryController@index')->name('category.index');
    // Route::get('/rows','Food\CategoryController@rows')->name('category.rows');

    //Route::resource('/','Food\CategoryController');
    Route::get('/','Food\CategoryController@index')->name('category.index');
    Route::post('/','Food\CategoryController@store')->name('category.store');

    Route::get('/get/all','Food\CategoryController@getRow')->name('category.get');
    Route::put('/{id}','Food\CategoryController@update')->name('category.update');
    Route::delete('/{id}','Food\CategoryController@destroy')->name('category.destroy');
    
});

// Route::resource('/category','Food\CategoryController');
// Route::get('/','Food\CategoryController@index')->name('category.index');
// Route::get('/rows','Food\CategoryController@rows')->name('category.rows');

// Route::resource('/category','Food\CategoryController');
// Route::get('/category','Food\CategoryController@index')->name('category.index');
// Route::get('/rows','Food\CategoryController@rows')->name('category.rows');

Route::prefix('product')->group(function(){
    Route::get('/','Food\ProductController@index')->name('product.index');
    Route::get('/rows','Food\ProductController@rows')->name('product.rows');
    Route::post('/','Food\ProductController@save')->name('product.save');
    Route::put('/{id}','Food\ProductController@update')->name('product.update');
    
});

// Route::resource('/product','Food\ProductController');
// Route::get('/product','Food\ProductController@index')->name('product.index');
// Route::post('/','Food\ProductController@save')->name('product.save');