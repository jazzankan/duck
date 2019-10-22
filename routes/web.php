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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route:: get('/upload', 'UploadController@index');

Route::get('/', 'HomeController@index')->name('home');

Route::resources(['/projects' => 'ProjectController']);

Route::get('/todos/create/{projectid}', 'TodoController@create')->name('newtask');

Route::resources(['/todos' => 'TodoController']);


