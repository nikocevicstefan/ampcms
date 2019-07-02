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

Route::get('/admin/posts', function (){
    return view('admin.post.index');
});


Route::get('/home', 'HomeController@index')->name('home');
