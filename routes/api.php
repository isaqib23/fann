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

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkResponse');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => ['jwt']], function() {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('me', 'Auth\LoginController@me');
    Route::post('profile', 'ProfileController@update');

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

    // ----- clean uninstall
    Route::patch('shopify/clean-uninstall', [
        'as' => 'shopify.clean-uninstall',
        'uses'  => 'ShopifyController@cleanUninstall'
    ]);

    // ----- code Generator find Products
    Route::get('/shopify/findProducts/{input}', 'ShopifyController@findProducts');

    // ----- Countries related api's
    Route::prefix('/country')->group(function () {

        // ----- get campaign objectives list
        Route::get('all', 'CountriesController@index')->name('country.all');
        Route::post('states', 'StatesController@index')->name('country.states');
    });

    // ----- Campaign related api's
    Route::prefix('/setting')->group(function () {

        // ----- get campaign objectives list
        Route::post('saveUserCard', 'SettingsController@store')->name('user.save_card');
        Route::post('addFunds', 'SettingsController@addFundsToStripe')->name('user.addFunds');
        Route::get('getUserCard', 'SettingsController@index')->name('user.get_cards');
        Route::get('getNiches', 'SettingsController@getNiches')->name('user.get_niches');
    });


    // ----- Campaign related api's
    Route::prefix('/campaign')->group(function () {

        // ----- get campaign objectives list
        Route::get('objectives', 'CampaignsController@getCampaignObjectives');
        Route::get('allPlacements', 'CampaignsController@getAllPlacements');
        Route::post('save', 'CampaignsController@store');
        Route::put('savePlacementAndPaymentType', 'CampaignsController@savePlacementAndPaymentType');
    });

});

