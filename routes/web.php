<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','web', ]

    ],
    function()
    {
        Route::get('/', function () {
            return view('welcome');
        });
        Auth::routes();
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('admin/roles','RoleController')->middleware('auth');
        Route::resource('admin/users','UserController')->middleware('auth');
        Route::resource('admin/employee','EmployeeController')->middleware('auth');

    });


