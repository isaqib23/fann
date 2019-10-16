<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:api']], function() {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('login/refresh', 'Auth\LoginController@refresh');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => ['jwt']], function() {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('me', 'Auth\LoginController@me');
    Route::put('profile', 'ProfileController@update');

    // ----- shopify handshake
    Route::get('shopify/install/{shop}', [
        'as' => 'shopify-install',
        'uses' => 'ShopifyController@install'
    ]);

    // ----- linked shops
    Route::get('shopify/linked-shops', [
        'as' => 'shopify-linked-shops',
        'uses' => 'ShopifyController@linkedShops'
    ]);

    // ----- publish product
    Route::put('shopify/publish', [
        'as' => 'shopify-linked-shops',
        'uses' => 'ShopifyController@publish'
    ]);

    // ----- delete zip
    Route::delete('upload/delete', [
        'as' => 'upload-delete',
        'uses' => 'UploadZipsController@delete'
    ]);

    // ----- clean uninstall
    Route::patch('shopify/clean-uninstall', [
        'as' => 'shopify.clean-uninstall',
        'uses'  => 'ShopifyController@cleanUninstall'
    ]);

    // ----- get countries list
    Route::get('/country/all', [
        'as' => 'country.all',
        'uses' => 'CountriesController@index'
    ]);
});

