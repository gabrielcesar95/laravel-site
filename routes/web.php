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
    Route::match(['get', 'post'], 'logout', 'Auth\LoginController@logout')->name('logout');

    // Registration
    Route::get('registrar', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('registrar', 'Auth\RegisterController@register');

    // Password Reset
    Route::get('senha/resetar', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('senha/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('senha/resetar/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('senha/resetar', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Email Verification
    Route::get('email/verificar', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verificar/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/reenviar', 'Auth\VerificationController@resend')->name('verification.resend');
});

/*
 **********************************************************************
 ********************************* WEB ********************************
 **********************************************************************
*/

Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {
    Route::get('/', 'HomeController@index')->name('home');


    Route::group(['prefix' => 'blog', 'as' => 'post.'], function () {
        // LIST/SEARCH
        Route::get('/', 'PostController@index')->name('index');
        Route::match(['get', 'post'], 'busca', 'PostController@filter')->name('search');
        // READ
        Route::get('/{slug}', 'PostController@show')->name('show');
    });

});
