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

use Illuminate\Support\Facades\Route;

\URL::forceScheme('https');
\URL::forceRootUrl(env('APP_URL'));

// ----- auth callback
Route::get('/shopify/auth-callback', [
    'as' => 'shopify.auth-callback',
    'uses' => 'ShopifyController@authCallback'
]);

// ----- uninstall hook callback
Route::post('/shopify/uninstall', [
    'as' => 'shopify.uninstall',
    'uses'  => 'ShopifyController@uninstall'
]);

Route::get('get-image', 'UploadZipsController@renderImage');
Route::get('test_route', 'SettingsController@show');

Route::post('upload-file', 'UploadZipsController@uploadFile');

// ----- Social Login related routes
Route::prefix('/social')->group(function () {
    Route::get('instagram/callback', 'UserPlatformsController@handleProviderInstagramCallback');
    Route::get('youtube/callback', 'UserPlatformsController@handleProviderYoutubeCallback');
});


Route::any('{all}', function () {
    return view('app');
})->where(['all' => '.*']);


