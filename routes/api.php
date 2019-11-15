<?php

use Illuminate\Http\Request;





Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){

	
	Route::get('test', 'UserController@test');

    /*crud productos*/
    Route::apiResource("products",'ProductoController');

});
