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

});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api', 'prefix' => 'user', 'as' => 'user.'], function () {
    // LIST/SEARCH
    Route::get('/', 'UserController@index')->name('index');
    Route::match(['get', 'post'], 'busca', 'UserController@filter')->name('search');
    // CREATE
    Route::get('/cadastrar', 'UserController@create')->name('create');
    Route::post('/cadastrar', 'UserController@store')->name('store');
    // READ
    Route::get('/{id}', 'UserController@show')->name('show');
    // UPDATE
    Route::get('/alterar/{id}', 'UserController@edit')->name('edit');
    Route::put('/alterar/{id}', 'UserController@update')->name('update');
    // DELETE
    Route::get('/deletar/{id}', 'UserController@delete')->name('delete');
    Route::delete('/deletar/{id}', 'UserController@destroy')->name('destroy');
});
