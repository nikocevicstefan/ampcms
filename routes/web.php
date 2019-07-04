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

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function (){
    return view('admin.layout');
});

Route::prefix('admin')->group(function (){
    Route::prefix('posts')->group(function (){
        Route::get('', 'PostController@index');
        Route::get('create', 'PostController@create');
        Route::post('', 'PostController@store');
        Route::get('{post}', 'PostController@edit');
        Route::patch('{post}', 'PostController@update');
        Route::delete('{post}', 'PostController@destroy');
    });

    Route::prefix('products')->group(function (){
        Route::get('', 'ProductController@index');
        Route::get('create', 'ProductController@create');
        Route::post('', 'ProductController@store');
        Route::get('{product}', 'ProductController@edit');
        Route::patch('{product}', 'ProductController@update');
        Route::delete('{product}', 'ProductController@destroy');
    });
});


Route::get('/admin/users', 'UserController@index');

Route::get('/admin/products', 'ProductController@index');

Route::get('/admin/job-postings', 'JobPostingController@index');


Route::get('/home', 'HomeController@index')->name('home');
