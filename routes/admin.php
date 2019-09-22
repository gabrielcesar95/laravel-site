<?php

/*
 **********************************************************************
 ********************************* ADMIN ******************************
 **********************************************************************
*/

use App\Http\Controllers\Admin\DashboardController;

Route::group(['prefix' => 'adm', 'as' => 'admin.'], function () {
    /* ******************************* DASHBOARD **************************** */
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'perfil', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@edit')->name('edit');
        Route::post('/', 'ProfileController@update')->name('update');
    });

    /* ********************************* USERS ****************************** */
    Route::group(['prefix' => 'usuarios', 'namespace' => 'User', 'as' => 'user.'], function () {
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

    /* ********************************* ROLES ****************************** */
    Route::group(['prefix' => 'grupos', 'namespace' => 'User', 'as' => 'role.'], function () {
        // LIST/SEARCH
        Route::get('/', 'RoleController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'RoleController@filter')->name('search');
        // CREATE
        Route::get('/cadastrar', 'RoleController@create')->name('create');
        Route::post('/cadastrar', 'RoleController@store')->name('store');
        // READ
        Route::get('/{id}', 'RoleController@show')->name('show');
        // UPDATE
        Route::get('/alterar/{id}', 'RoleController@edit')->name('edit');
        Route::put('/alterar/{id}', 'RoleController@update')->name('update');
        // DELETE
        Route::get('/deletar/{id}', 'RoleController@delete')->name('delete');
        Route::delete('/deletar/{id}', 'RoleController@destroy')->name('destroy');
    });

    /* ********************************* LOGS ****************************** */
    Route::group(['prefix' => 'logs', 'namespace' => 'Logs', 'as' => 'logs.'], function () {
        // LIST/SEARCH
        Route::get('/', 'LogsController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'LogsController@filter')->name('search');
        // READ
        Route::get('/{id}', 'LogsController@show')->name('show');
    });

});
