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

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	Route::resource('substasks', 'SubstaskController');
	Route::resource('tasks', 'TaskController');
	Route::resource('projects', 'ProjectController');
	Route::resource('test', 'TestController');
});

Auth::routes();

Route::get('logout', 'HomeController@destroy');
Route::post('simpan', 'ProjectController@simpan');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
