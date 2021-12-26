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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/course-details', 'HomeController@courseDetails')->name('course-details');
Route::get('/trainers', 'HomeController@trainers')->name('trainers');
Route::get('/contact', 'HomeController@contact')->name('contact');



// Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Auth', 'middleware' => 'web'], function () {
    Route::get('/', array('as' => 'admin', 'uses' => 'AuthController@redirectLogin'));
    Route::get('', array('as' => 'admin', 'uses' => 'AuthController@redirectLogin'));
    Route::get('login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => '', 'before' => 'csrf', 'uses' => 'AuthController@postLogin'));
    Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
});

// User routes
Route::group(['prefix' => 'user', 'middleware' => 'web'], function () {
    Route::get('login', function () {
        return view('auth.login');
    });
    Route::post('login', array('as' => 'user.login', 'before' => 'csrf', 'uses' => 'AuthController@postLogin'));
    Route::get('logout', array('as' => 'user.logout', 'uses' => 'AuthController@getLogout'));
    Route::post('logout', array('as' => 'user.logout', 'uses' => 'AuthController@getLogout'));
    Route::post('reset-password', 'AuthController@resetPassword')->name('user.reset-ppassword');
    Route::get('register', array('as' => 'register', 'uses' => 'AuthController@register'));
    Route::post('register', 'AuthController@postRegister')->name('user.register');
});
Route::group(['middleware' => ['preventUserBackHistory', 'auth:user'], 'prefix' => 'user'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');
    Route::get('history', 'DashboardController@history')->name('user.history');
    Route::get('mileage', 'DashboardController@mileage')->name('user.mileage');
    Route::post('change-password', 'DashboardController@changePassword')->name('user.change-password');
});