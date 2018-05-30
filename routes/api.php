<?php

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/products' , 'ProductController');
Route::apiResource('/comments' , 'CommentController');

/** Castom Route **/
Route::get('product/{product}', 'ProductController@getProductAndComments');
Route::post('product/{product}/comments', 'CommentController@addComments');
//Route::post('product/company/{company}', 'ProductController@store');