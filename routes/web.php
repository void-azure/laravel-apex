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

// Landing page.
Route::get('/', function () {
    return view('welcome');
});

// Auth routes.
Auth::routes(['verify' => true]);

// Home route.
Route::get('/home', 'HomeController@index')->name('home');

// Password management routes.


// Admin routes.
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    // User management route.
    Route::resource('/users', 'UserController');

    // Impersonate routes.
    Route::get('/impersonate/user/take/{id}', 'ImpersonateController@take')->name('impersonate.take');
    Route::get('/impersonate/user/leave', 'ImpersonateController@leave')->name('impersonate.leave');
});

// Two-Factor auth routes.
Route::get('/two-factor/verify', 'VerifyController@index')->name('twofactor.index');
Route::post('/two-factor/verify/process', 'VerifyController@verify')->name('twofactor.verify');

// Chat routes.
Route::get('/rooms/{id}', 'ChatController@index')->name('chat.index');
Route::get('/rooms/messages/{id}', 'ChatController@fetchMessages')->name('chat.messages');
Route::post('/rooms/messages/send/{id}', 'ChatsController@sendMessage')->name('chat.messages.send');
