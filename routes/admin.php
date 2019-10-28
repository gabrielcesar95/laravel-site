<?php

/*
 **********************************************************************
 ********************************* ADMIN ******************************
 **********************************************************************
*/

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

    /* ********************************* CATEGORIES ****************************** */
    Route::group(['prefix' => 'categorias', 'as' => 'category.'], function () {
        // LIST/SEARCH
        Route::get('/', 'CategoryController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'CategoryController@filter')->name('search');
        // CREATE
        Route::get('/cadastrar', 'CategoryController@create')->name('create');
        Route::post('/cadastrar', 'CategoryController@store')->name('store');
        // READ
        Route::get('/{id}', 'CategoryController@show')->name('show');
        // UPDATE
        Route::get('/alterar/{id}', 'CategoryController@edit')->name('edit');
        Route::put('/alterar/{id}', 'CategoryController@update')->name('update');
        // DELETE
        Route::get('/deletar/{id}', 'CategoryController@delete')->name('delete');
        Route::delete('/deletar/{id}', 'CategoryController@destroy')->name('destroy');
    });

    /* *********************************** POSTS ********************************* */
    Route::group(['prefix' => 'postagens', 'as' => 'post.'], function () {
        // LIST/SEARCH
        Route::get('/', 'PostController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'PostController@filter')->name('search');
        // CREATE
        Route::get('/cadastrar', 'PostController@create')->name('create');
        Route::post('/cadastrar', 'PostController@store')->name('store');
        // READ
        Route::get('/{id}', 'PostController@show')->name('show');
        Route::get('/{id}/comentarios', 'PostController@comments')->name('comments');
        // UPDATE
        Route::get('/alterar/{id}', 'PostController@edit')->name('edit');
        Route::put('/alterar/{id}', 'PostController@update')->name('update');
        // DELETE
        Route::get('/deletar/{id}', 'PostController@delete')->name('delete');
        Route::delete('/deletar/{id}', 'PostController@destroy')->name('destroy');
    });

    /* ********************************* COMMENTS ******************************** */
    Route::group(['prefix' => 'comentarios', 'as' => 'comment.'], function () {
        // LIST/SEARCH
        Route::get('/', 'CommentController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'CommentController@filter')->name('search');
        // CREATE
        Route::get('/cadastrar', 'CommentController@create')->name('create');
        Route::post('/cadastrar', 'CommentController@store')->name('store');
        // READ
        Route::get('/{id}', 'CommentController@show')->name('show');
        // UPDATE
        Route::get('/alterar/{id}', 'CommentController@edit')->name('edit');
        Route::put('/alterar/{id}', 'CommentController@update')->name('update');
        // DELETE
        Route::get('/deletar/{id}', 'CommentController@delete')->name('delete');
        Route::delete('/deletar/{id}', 'CommentController@destroy')->name('destroy');
    });

    /* *********************************** CONTACTS ********************************* */
    Route::group(['prefix' => 'contatos', 'as' => 'contact.'], function () {
        // LIST/SEARCH
        Route::get('/', 'ContactController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'ContactController@filter')->name('search');
        // READ
        Route::get('/{id}', 'ContactController@show')->name('show');
        // DELETE
        Route::get('/deletar/{id}', 'ContactController@delete')->name('delete');
        Route::delete('/deletar/{id}', 'ContactController@destroy')->name('destroy');
    });

    /* ********************************* LOGS ****************************** */
    Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
        // LIST/SEARCH
        Route::get('/', 'LogsController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'LogsController@filter')->name('search');
        // READ
        Route::get('/{id}', 'LogsController@show')->name('show');
    });

    /* ********************************* NOTIFICATIONS ****************************** */
    Route::group(['prefix' => 'notificacoes', 'as' => 'notifications.'], function () {
        // LIST
        Route::get('/listar', 'NotificationController@list')->name('list');
    });

});
