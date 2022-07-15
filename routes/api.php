<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('blog')->group(function () {
    Route::prefix('before')->group(function () {
        Route::post('store', 'BeforeBlogController@store');
        Route::post('update', 'BeforeBlogController@update');
        Route::post('delete', 'BeforeBlogController@delete');
    });

    Route::prefix('after')->group(function () {
        Route::post('store', 'AfterBlogController@store');
        Route::post('update', 'AfterBlogController@update');
        Route::post('delete', 'AfterBlogController@delete');
    });
});
