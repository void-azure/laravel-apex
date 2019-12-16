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

// Admin routes.
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    // User management route.
    Route::resource('/users', 'UserController');

    

    // Impersonate routes.
    Route::get('/impersonate/user/take/{id}', 'ImpersonateController@take')->name('impersonate.take');
    Route::get('/impersonate/user/leave', 'ImpersonateController@leave')->name('impersonate.leave');
});