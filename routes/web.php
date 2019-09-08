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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {return redirect('/login');});

Route::group(['prefix'=>'admin'] ,function (){

    Route::get('lang/{locale}', function ($locale = 'en'){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });

    Route::get('/panel', function (){
        if(!session()->exists('locale')){session()->put('locale', 'me');}
        $user = Auth::user();
        return view('admin.panel',compact('user'));
    })->middleware('auth');

    Route::group(['prefix'=> 'posts'], function (){
        Route::get('', 'PostController@index')->name("posts");
        Route::post('search', 'PostController@search');
        Route::get('create', 'PostController@create');
        Route::post('', 'PostController@store');
        Route::get('{id}/status', 'PostController@status');
        Route::get('{id}', 'PostController@edit');
        Route::patch('{id}', 'PostController@update');
        Route::delete('{id}', 'PostController@destroy');
    });

    Route::group(['prefix'=> 'products'], function (){
        Route::get('', 'ProductController@index')->name('products');
        Route::get('create', 'ProductController@create');
        Route::post('search', 'ProductController@search');
        Route::post('', 'ProductController@store');
        Route::get('{id}/status', 'ProductController@status');
        Route::delete('{id}', 'ProductController@destroy');
        Route::get('{id}', 'ProductController@edit');
        Route::patch('{id}', 'ProductController@update');
    });

    Route::group(['prefix'=> 'job-postings'], function (){
        Route::get('', 'JobPostingController@index')->name('job-postings');
        Route::get('create', 'JobPostingController@create');
        Route::post('search', 'JobPostingController@search');
        Route::post('', 'JobPostingController@store');
        Route::get('{id}/status', 'JobPostingController@status');
        Route::get('{id}', 'JobPostingController@edit');
        Route::patch('{id}', 'JobPostingController@update');
        Route::delete('{id}', 'JobPostingController@destroy');
    });

    Route::get('/users/{user}/profile', 'UserController@show');
    Route::patch('/users/{user}/change-password', 'UserController@changePassword');
    Route::patch('/users/{user}/change-image', 'UserController@changeImage');

    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function (){
        Route::get('', 'UserController@index')->name('users');
        Route::get('create', 'UserController@create');
        Route::post('search', 'UserController@search');
        Route::post('', 'UserController@store');
        Route::get('{id}/role', 'UserController@role');
        Route::get('{id}', 'UserController@edit');
        Route::patch('{id}', 'UserController@update');
        Route::delete('{id}', 'UserController@destroy');
    });
});
