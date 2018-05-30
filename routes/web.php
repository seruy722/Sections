<?php

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::resource('api/news', 'Api\NewsController');
Route::resource('api/addNews', 'Api\NewsController');
Route::post('api/updateNews', 'Api\NewsController@userUpdateNews');
Route::post('api/userNews', 'Api\NewsController@userNews');
Route::resource('api/users', 'Api\UserController');
Route::resource('/createMail', 'MailExchangeController');
Route::resource('/deleteMail', 'MailExchangeController');
Route::post('/updateMail', 'MailExchangeController@updateMail');
Route::post('/mailsForUser', 'MailExchangeController@mailsForUser');
Route::resource('/add_image', 'ImageGalleryController');

Route::view('/controls', 'controls');

Route::get('/404',function(){
    abort(404);
});
Route::get('/500',function(){
    abort(500);
});
//Route::resource('api/schedules', 'Api\SchedulesController')
//    ->only(['index', 'show']);
Route::get('/', 'FrontController@index');
Route::get('/articles/{id}', 'FrontController@show')->name('articles');
Route::get('/articles', 'FrontController@all')->name('news');
Route::any('/articles/search', 'FrontController@search');
Route::any('/search', 'FrontController@searchAll');

Route::get('/sections/section/{id}', 'SectionsController@index')->name('section');
Route::get('/sections/{id}', 'SectionsController@sections')->name('sections');
Route::any('/section/send', 'SectionsController@mail')->name('mail');
Route::post('/userSections', 'SectionsController@getUserSections');
Route::resource('/addSections', 'SectionsController');
Route::resource('/deleteSection', 'SectionsController');
Route::post('/updateSection', 'SectionsController@update');

Route::get('/gallery', function () {
    return view('gallery');
});