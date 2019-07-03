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

Route::get('/admin/posts', 'PostController@index');

Route::get('/admin/users', 'UserController@index');

Route::get('/admin/products', 'ProductController@index');

Route::get('/admin/job-postings', 'JobPostingController@index');


Route::get('/home', 'HomeController@index')->name('home');
