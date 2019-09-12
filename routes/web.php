<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;


/*
 **********************************************************************
 ********************************* AUTH *******************************
 **********************************************************************
*/

Route::group(['name' => 'auth'], function () {
    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email Verification
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

/*
 **********************************************************************
 ********************************* WEB ********************************
 **********************************************************************
*/

Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

/*
 **********************************************************************
 ********************************* ADMIN ******************************
 **********************************************************************
*/
Route::group(['prefix' => 'adm', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    /* ******************************* DASHBOARD **************************** */
    Route::get('/', 'DashboardController@index')->name('index');

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

});
