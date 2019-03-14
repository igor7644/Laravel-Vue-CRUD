<?php

use Illuminate\Http\Request;

Route::middleware('api')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

});

