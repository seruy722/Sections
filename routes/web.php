<?php

use App\User;

Route::get('/', function () {
    return view('index');
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::resource('api/news', 'Api\NewsController');
    Route::resource('api/addNews', 'Api\NewsController');
    Route::post('api/updateNews', 'Api\NewsController@userUpdateNews');
    Route::post('api/userNews', 'Api\NewsController@userNews');
    Route::resource('api/users', 'Api\UserController');
    Route::resource('/createMail', 'MailExchangeController');
    Route::resource('/deleteMail', 'MailExchangeController');
    Route::resource('/getEmails', 'MailExchangeController');
    Route::post('/updateMail', 'MailExchangeController@updateMail');
    Route::post('/mailsForUser', 'MailExchangeController@mailsForUser');
    Route::post('/unreadMessage', 'MailExchangeController@getUnreadMessage');
    Route::resource('/addImage', 'ImageGalleryController');
    Route::resource('/deleteImage', 'ImageGalleryController');
    Route::post('/imagesGallery', 'ImageGalleryController@getImages');
    Route::resource('/addSchedule', 'ScheduleController');
    Route::post('/schedules', 'ScheduleController@getSchedules');
    Route::post('/editSchedule', 'ScheduleController@update');
    Route::resource('/deleteSchedule', 'ScheduleController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/deleteCategories', 'CategoryController');
    Route::resource('/addCategory', 'CategoryController');
    Route::post('/editCategory', 'CategoryController@update');
    Route::post('/adminEmail', 'AuthController@getAdminEmail');
    Route::post('/addSocialsLinks', 'SocialController@store');
    Route::post('/getSocialsLinks', 'SocialController@getSocialsLinks');
    Route::post('/updateSection', 'SectionsController@update');
    Route::post('/userSections', 'SectionsController@getUserSections');
    Route::resource('/addSections', 'SectionsController');
    Route::resource('/deleteSection', 'SectionsController');

});


Route::view('/controls', 'controls');

Route::get('/404', function () {
    abort(404);
});
Route::get('/500', function () {
    abort(500);
});

Route::get('/', 'FrontController@index');
Route::get('/articles/{id}', 'FrontController@show')->name('articles');
Route::get('/articles', 'FrontController@all')->name('news');
Route::any('/articles/search', 'FrontController@search');
Route::any('/search', 'FrontController@searchAll');

Route::get('/sections/section/{id}', 'SectionsController@index')->name('section');
Route::get('/sections/{id}', 'SectionsController@sections')->name('sections');
Route::any('/section/send', 'SectionsController@mail')->name('mail');


Route::get('/sections/gallery/{id}', 'SectionsController@gallery')->name('gallery');

View::composer(['*'], function ($view) {
    $adminFeedbackEmail = User::where('role', 'admin')->value('feedback_email');
    $view->with('admin', $adminFeedbackEmail);
});

