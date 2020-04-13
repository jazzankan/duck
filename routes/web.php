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
Route::get('/blog', 'BlogController@index');

Auth::routes(['register' => false]);

Route:: get('/upload/{projectid}', function($projectid) {
    return view('upload')->with('projectid', $projectid);
});
Route:: get('/memupload/{memoryid}', function($memoryid) {
    return view('memupload')->with('memoryid', $memoryid);
});

Route:: post('/uploadfile', 'UploadController@index');

Route:: post('/uploadmemory', 'UploadController@memories');

Route::get('/', 'HomeController@index')->name('home');

Route::resources(['/projects' => 'ProjectController']);

Route::get('/todos/create/{projectid}', 'TodoController@create')->name('newtask');

Route::resources(['/todos' => 'TodoController']);

Route::get('/todos' , 'TodoController@list');

Route::resources(['/memories' => 'MemoryController']);

Route::post('/memories','MemoryController@index');

Route::post('/memories/create','MemoryController@store');






