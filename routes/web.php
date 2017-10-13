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

Route::resource('/articles','ArticlesController');
//Route::get('/profile', 'StaticsController@profile');
//Route::post('/login', 'SessionsController@login');
//Route::put('/password-reset/{id}',
//'SessionsController@password_reset');
//Route::delete('/remove-baned', 'SessionsController@remove_baned');
