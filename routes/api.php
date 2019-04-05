<?php

use Illuminate\Http\Request;

Route::middleware('api')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/users', 'UserController@index');
    Route::post('/user/{user}/destroy', 'UserController@destroy');
    Route::post('/user/{user}/edit', 'UserController@edit');

});

