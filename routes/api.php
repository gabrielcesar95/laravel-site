<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::get('/me', 'UserController@me')->name('me');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::post('/', 'UserController@store')->name('store');
        Route::get('/{id}', 'UserController@show')->name('show');
        Route::put('/{id}', 'UserController@update')->name('update');
        Route::delete('/{id}', 'UserController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', 'RoleController@index')->name('index');
        Route::post('/', 'RoleController@store')->name('store');
        Route::get('/{id}', 'RoleController@show')->name('show');
        Route::put('/{id}', 'RoleController@update')->name('update');
        Route::delete('/{id}', 'RoleController@destroy')->name('destroy');
    });

});
