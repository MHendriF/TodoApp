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
	Route::model('tasks', 'App\Task');
	Route::model('subtask', 'App\Subtask');
	
	Route::bind('projects', function($value, $route){
		return App\Project::whereSlug($value)->first();
	});

	Route::bind('tasks', function($value, $route){
		return App\Task::whereSlug($value)->first();
	});

	Route::bind('subtasks', function($value, $route){
		return App\Subtask::whereSlug($value)->first();
	});

	Route::bind('trashedprojects', function($value, $route){
		return App\Project::onlyTrashed()->whereSlug($value)->first();
	});

	Route::bind('trashedtasks', function($value, $route){
		return App\Task::onlyTrashed()->whereSlug($value)->first();
	});

	Route::get('projects/trashed', 'ProjectController@trashed');
	Route::get('tasks/trashed', 'TaskController@trashed');
	Route::get('projects/restoreall', 'ProjectController@restoreall');

	Route::get('projects', 'ProjectController@index');
	Route::get('projects/{projects}', 'ProjectController@show');

	Route::delete('projects/{trashedprojects}/restore', 'ProjectController@restore');
	Route::delete('tasks/{trashedtasks}restore', 'TaskController@restore');

	Route::delete('projects/{trashedprojects}/deleteforever', 'ProjectController@deleteforever');

	Route::post('projects/{projects}/edit', 'ProjectController@edit');
	Route::post('projects/{projects}/tasks/{tasks}/edit', 'TaskController@edit');

	Route::patch('projects/{project}', 'ProjectController@update');
	Route::patch('projects/{projects}/tasks/{tasks}', 'TaskController@update');

	Route::patch('projects/{projects}/completed', 'ProjectController@completed');
	Route::patch('projects/{projects}/tasks/{tasks}/completed', 'TaskController@completed');

	Route::delete('projects/{projects}/hide', 'ProjectController@hide');
	Route::delete('projects/{projects}/tasks/{tasks}/hide', 'TaskController@hide');

	Route::post('projects', 'ProjectController@store');
	Route::post('projects/{project}/task', 'TaskController@store');

	
	//Route::resource('projects', 'ProjectController');
	Route::resource('projects.tasks.substasks', 'SubtaskController');
	//Route::resource('projects.tasks', 'TaskController');
	//Route::resource('test', 'TestController');

	// Route::post('service_status/{id}', 'ServiceStatusController@update');
	// Route::get('service_status', 'ServiceStatusController@index');
	// Route::get('service_status/create', 'ServiceStatusController@create');
	// Route::get('service_status/{id}/edit', 'ServiceStatusController@edit');
	// Route::post('service_status', 'ServiceStatusController@store');
});

Auth::routes();

Route::get('logout', 'HomeController@destroy');
Route::post('simpan', 'ProjectController@simpan');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
