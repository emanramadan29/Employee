<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([

    'middleware' => ['api','cors'],

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group( ['middleware' => [ 'jwt.auth','cors','api']],  function(){

    Route::get('/employee','EmployeeController@index');
    Route::post('/employee','EmployeeController@store');
    Route::get('/employee/{id}','EmployeeController@show');
    Route::post('/employee/{id}','EmployeeController@update');
    Route::delete('/employee/{id}','EmployeeController@destroy');

    Route::get('/salary','SalaryController@getMonthlySalary');



} );


