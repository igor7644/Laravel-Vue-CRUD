<?php

use Illuminate\Http\Request;

Route::middleware('api')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/users', 'UserController@index');
    Route::post('/user/{user}/destroy', 'UserController@destroy');
    Route::post('/user/{user}/edit', 'UserController@edit');
    Route::post('/user/create', 'UserController@create');

    Route::get('/posts', 'PostController@index');
    Route::post('/post/{post}/destroy', 'PostController@destroy');
    Route::post('/post/{post}/edit', 'PostController@edit');
    Route::post('/post/create', 'PostController@create');

});

