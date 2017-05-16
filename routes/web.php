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

Route::get('/', function () {
    return view('welcome');
});

Route::get('start', function() {
	return view('start');
});

Route::get('login', function() {
	return view('login');
});

Route::get('signup', function() {
	return view('signup');
});

Route::get('services', 'ServicesController@status');

Route::get('index', ['middleware' => 'auth', function(){
	return view('index');
}]);

Route::get('compose', 'ComposeController@index');

Route::post('signup', 'UsersController@signup');

Route::post('login', 'UsersController@login');

Route::get('/logout', 'UsersController@logout');

Route::post('add', 'ComposeController@add');

Route::get('/compose/show/{id}', 'ComposeController@show');

Route::get('/compose/edit/{id}', 'ComposeController@edit');

Route::resource('compose', 'ComposeController');

Route::delete('/compose/{id}', 'ComposeController@destroy');

Route::put('/compose/{id}', 'ComposeController@update');

Route::get('/candidates', 'CandidatesController@index');

Route::get('/candidates/show/{id}', 'CandidatesController@show');

Route::resource('candidates', 'CandidatesController');

Route::get('assessments', 'CandidatesController@fetch');

Route::post('execute', 'AssessmentsController@executeSparkCode');

Route::get('profiles', 'ProfilesController@fetch');

Route::get('/years', 'ProfilesController@years');

Route::get('/months', 'ProfilesController@months');

Route::get('/yearsWiseData', 'ProfilesController@yearsWiseData');

Route::get('/monthsWiseData', 'ProfilesController@monthsWiseData');

Route::get('/daysWiseData', 'ProfilesController@daysWiseData');

Route::get('/comparator', 'ComparatorController@index');

Route::get('/storage', 'StorageController@index');

Route::get('/yearsWiseComparison', 'ComparatorController@yearsWiseComparison');

Route::get('/getYears', 'ComparatorController@getYears');

Route::get('/getMonths', 'ComparatorController@getMonths');

Route::get('/getDays', 'ComparatorController@getDays');

Route::get('/monthsWiseComparison', 'ComparatorController@monthsWiseComparison');

Route::get('/daysWiseComparison', 'ComparatorController@daysWiseComparison');

Route::delete('/deleteCSV/{id}', 'StorageController@destroyCSV');

Route::delete('/deleteRecords/{id}', 'StorageController@deleteRecords');

Route::get('/queues', 'QueuesController@index');
