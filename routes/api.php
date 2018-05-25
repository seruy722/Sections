<?php


use Illuminate\Http\Request;


Route::post('/upload_file', 'FilesController@upload');
Route::post('/save_headers', 'FilesController@saveHeaders');
Route::post('/list', 'FilesController@list');
Route::post('/delete/{file}', 'FilesController@delete');
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/reset_password', 'AuthController@resetPassword');
Route::post('/logout', 'AuthController@logout');
Route::post('/edit_profile', 'AuthController@editProfile');
Route::post('/update_profile', 'AuthController@updateProfile');