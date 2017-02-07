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

Route::get('index', function(){
	return view('index');
});

Route::post('signup', 'UsersController@signup');

Route::post('login', 'UsersController@login');

Route::get('/logout', 'UsersController@logout');