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

	Route::model('projects', 'App\Project');
	
	Route::bind('projects', function($value, $route){
		return App\Project::whereSlug($value)->first();
	});

	// Route::bind('slugs', function($value, $route){
	// 	return App\Project::whereSlug($value)->first();
	// });

	Route::bind('trashedprojects', function($value, $route){
		return App\Project::onlyTrashed()->whereSlug($value)->first();
	});

	// Route::post('projects/{slugs}', 'ProjectController@show');

	Route::post('projects/{projects}/edit', 'ProjectController@edit');
	Route::patch('projects/{projects}/completed', 'ProjectController@completed');
	Route::delete('projects/{projects}/hide', 'ProjectController@hide');
	Route::get('projects/trashed', 'ProjectController@trashed');
	Route::get('projects/restoreall', 'ProjectController@restoreall');

	Route::delete('projects/{trashedprojects}/restore', 'ProjectController@restore');
	Route::delete('projects/{trashedprojects}/deleteforever', 'ProjectController@deleteforever');

	Route::resource('substasks', 'SubtaskController');
	Route::resource('tasks', 'TaskController');
	Route::resource('projects', 'ProjectController');
	Route::resource('test', 'TestController');
});

Auth::routes();

Route::get('logout', 'HomeController@destroy');
Route::post('simpan', 'ProjectController@simpan');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
