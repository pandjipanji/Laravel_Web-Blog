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

Route::resource('articles','ArticlesController');
Route::resource('comments','CommentsController');
Route::get('img/{id}','ArticlesController@show_img')->name('show_img');
Route::put('change/{id}','ArticlesController@update_img')->name('change_img');
Route::delete('delete/{id}','ArticlesController@delete_img')->name('delete_img');
Route::get('export','ArticlesController@export_all')->name('export_xls');
Route::post('import','ArticlesController@import')->name('import');

Route::get('signup', 'UsersController@signup')->name('signup');
Route::post('signup', 'UsersController@signup_store')->name('signup.store');

Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@login_store')->name('login.store');
Route::get('logout', 'SessionsController@logout')->name('logout');

//this routes for check if email user is exist in database
Route::get('forgot-password', 'ReminderController@create')->name('reminders.create');
Route::post('forgot-password', 'ReminderController@store')->name('reminders.store');

//this routes for handle changes password
Route::get('reset-password/{id}/{token}', 'ReminderController@edit')->name('reminders.edit');
Route::post('reset-password/{id}/{token}', 'ReminderController@update')->name('reminders.update');

//Route::get('/profile', 'StaticsController@profile');
//Route::post('/login', 'SessionsController@login');
//Route::put('/password-reset/{id}',
//'SessionsController@password_reset');
//Route::delete('/remove-baned', 'SessionsController@remove_baned');