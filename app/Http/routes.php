<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','IndexController@index');
Route::post('/register','IndexController@register');
Route::post('/login','IndexController@login');
//Route::get('/checkLogin/{phone}/{password}','IndexController@checkLogin');

Route::group(['prefix'=>'user'],function(){
   Route::get('/home','UserController@home');
});