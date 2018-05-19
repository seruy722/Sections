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
    return view('index');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::resource('api/news', 'Api\NewsController');
Route::resource('api/users', 'Api\UserController');


Route::resource('/', 'SiteSettingsCotroller');

//Route::resource('api/schedules', 'Api\SchedulesController')
//    ->only(['index', 'show']);
Route::get('/', 'SchedulesController@days');
//Route::get('/', 'SchedulesController@friday');