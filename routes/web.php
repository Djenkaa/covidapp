<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/country', 'HomeController@country')->name('country');
Route::post('/country/get','HomeController@getCountry')->name('country.get');
Route::post('/country/date', 'HomeController@byDate')->name('country.byDate');

Route::get('/travel', 'HomeController@travel')->name('travel');
Route::get('/support', 'HomeController@support')->name('support');

Route::post('/travel/news', 'HomeController@news')->name('travel.news');

//Route::group(['middleware' => 'auth'], function () {
//	Route::resource('user', 'UserController', ['except' => ['show']]);
//	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
//	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
//	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
//});

