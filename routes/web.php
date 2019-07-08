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

use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('/', function () {
    return redirect('/login');
});



Route::group(['prefix'=>'admin'] ,function (){

    Route::get('', function (){
        $user = Auth::user();
        return view('admin.layout', compact('user'));
    })->middleware('auth');

    Route::group(['prefix'=> 'posts'], function (){
        Route::get('', 'PostController@index');
        Route::get('create', 'PostController@create');
        Route::post('', 'PostController@store');
        Route::get('{post}', 'PostController@edit');
        Route::patch('{post}', 'PostController@update');
        Route::delete('{post}', 'PostController@destroy');
    });

    Route::group(['prefix'=> 'products'], function (){
        Route::get('', 'ProductController@index');
        Route::get('create', 'ProductController@create');
        Route::post('', 'ProductController@store');
        Route::get('{product}', 'ProductController@edit');
        Route::patch('{product}', 'ProductController@update');
        Route::delete('{product}', 'ProductController@destroy');
    });

    Route::group(['prefix'=> 'jobs'], function (){
        Route::get('', 'JobPostingController@index');
        Route::get('create', 'JobPostingController@create');
        Route::post('', 'JobPostingController@store');
        Route::get('{product}', 'JobPostingController@edit');
        Route::patch('{product}', 'JobPostingController@update');
        Route::delete('{product}', 'JobPostingController@destroy');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function (){
        Route::get('', 'UserController@index');
        Route::get('create', 'UserController@create');
        Route::post('', 'UserController@store');
        Route::get('{user}', 'UserController@edit');
        Route::patch('{user}', 'UserController@update');
        Route::delete('{user}', 'UserController@destroy');
    });
});
