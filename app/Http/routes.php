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
//Route::get('/getId/{phone}','IndexController@getId');
//Route::get('/checkLogin/{phone}/{password}','IndexController@checkLogin');

Route::group(['prefix'=>'/user'],function(){
    Route::get('/home','UserController@home');
    Route::get('/getFriends','UserController@getFriends');
    Route::get('/getGroup','UserController@getGroupById');
    Route::any('/addFriend','UserController@addFriend');
    Route::post('/friendHandle','UserController@friendHandle');
    Route::get('/handleResult/{from}/{to}/{pass}','UserController@handleResult');
    Route::get('/addFriendGroup1','UserController@addFriendGroup1');
    Route::post('/addFriendGroup2','UserController@addFriendGroup2');
});

Route::group(['prefix'=>'/equipment'],function(){
    Route::get('/home','EquipmentController@home');
    Route::get('/addHost1','EquipmentController@addHost1');
    Route::post('/addHost2','EquipmentController@addHost2');
    Route::get('/addEquip1','EquipmentController@addEquip1');
    Route::get('/addEquip2/{id}','EquipmentController@addEquip2');
    Route::get('/deleteEquip1','EquipmentController@deleteEquip1');
    Route::post('/deleteEquip2','EquipmentController@deleteEquip2');
});

Route::group(['prefix'=>'/quick'],function(){
    Route::get('/home','QuickController@home');
    Route::get('/groupInfo/{id}','QuickController@groupInfo');
    Route::get('/addGroup1','QuickController@addGroup1');
    Route::post('/addGroup2','QuickController@addGroup2');
    Route::get('/deleteGroup1','QuickController@deleteGroup1');
    Route::post('/deleteGroup2','QuickController@deleteGroup2');
    Route::get('/group/{id}/addEquip1','QuickController@addEquip1');
    Route::get('/group/{id}/deleteEquip1','QuickController@deleteEquip1');
    Route::post('/addEquip2','QuickController@addEquip2');
    Route::post('/deleteEquip2','QuickController@deleteEquip2');
    Route::post('/singleSwitch','QuickController@singleSwitch');
    Route::get('/group/{id}/allSwitch/{status}','QuickController@allSwitch');
});