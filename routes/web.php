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

Route::get('/', 'PagesController@index');
Route::post('/', 'PagesController@index');
Route::post('/like-post', 'PagesController@like_post');
Route::get('/games-page', 'PagesController@games');
Route::get('/about', 'PagesController@about');

Route::get('/profile', 'UsersController@profile');
Route::put('/profile', 'UsersController@profile');

Route::get('/profile/password', 'UsersController@password');
Route::put('/profile/password', 'UsersController@password');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/configuration', 'ConfigurationController@index');
Route::post('/configuration', 'ConfigurationController@index');

Route::get('/users', 'UsersController@index');
Route::get('/users/select_users', 'UsersController@select_users');
Route::post('/users/update_role', 'UsersController@update_role');

Route::get('/carousels/sort','CarouselsController@sort')->name('carousels.sort');
Route::post('/carousels/sort','CarouselsController@sort')->name('carousels.sort');
Route::resource('carousels','CarouselsController');

Route::resource('games','GamesController');

Route::resource('dashboard','DashboardController');

Auth::routes();
