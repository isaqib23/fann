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
    Route::post('/shopify/findProducts', 'ShopifyController@findProducts');
    // ----- code Generator find Product
    Route::post('/shopify/findSingleProduct', 'ShopifyController@findSingleProduct');

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

        Route::post('socialPlatformLogin', 'UserPlatformsController@index');
        Route::get('getUserPlatforms', 'UserPlatformsController@getUserPlatforms')->name('user.getUserPlatforms');

        Route::post('saveUserDetail', 'UserController@create')->name('user.saveUserDetail');
        Route::get('getUserDetail', 'UserController@index')->name('user.getUserDetail');
        Route::get('getUserCompany', 'CompanyUsersController@index')->name('user.getUserCompany');

    });


    // ----- Campaign related api's
    Route::prefix('/campaign')->group(function () {

        // ----- get campaign objectives list
        Route::get('objectives', 'CampaignsController@getCampaignObjectives');
        Route::get('allPlacements', 'CampaignsController@getAllPlacements');
        Route::post('save', 'CampaignsController@store');
        Route::post('saveTouchPoint', 'CampaignsController@saveTouchPoint');
        Route::post('saveInvitation', 'CampaignsController@saveInvitation');
        Route::put('savePlacementAndPaymentType', 'CampaignsController@savePlacementAndPaymentType');
        Route::post('getCampaignTouchPoint', 'CampaignsController@getCampaignTouchPoint');
        Route::post('getCampaignSavedObjective', 'CampaignsController@getCampaignSavedObjective');
        Route::post('updateCampaignStatus', 'CampaignsController@updateCampaignStatus');
    });

    // ----- User related api's
    Route::prefix('/user')->group(function () {
        Route::post('searchInfluencers', 'UserController@searchInfluencers');
    });

    // ----- Campaign Manage related api's
    Route::prefix('/campaign_manage')->group(function () {
        Route::post('getActiveCampaigns', 'CampaignsController@getActiveCampaigns');
        Route::post('getCampaignById', 'CampaignsController@getCampaignById');
        Route::post('getPlacementTouchPoint', 'CampaignsController@getPlacementTouchPoint');
        Route::post('getCampaignProposal', 'CampaignsController@getCampaignProposal');
        Route::post('getInfluencerAssignTouchPoint', 'CampaignsController@getInfluencerAssignTouchPoint');
        Route::post('getInfluencerCampaign', 'CampaignsController@getInfluencerCampaign');
    });



});

