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

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    // Authentication
    Route::post('/users/login', "UserAuthController@login");
    Route::post('/users/register', "UserAuthController@register");

    Route::group(['middleware' => 'jwt.auth'], function () {
        // Sections
        Route::apiResource('sections', 'SectionController');

        // Messages
        Route::apiResource('messages', 'MessageController');

        // Topics
        Route::get('/topics/{topic}/thread', 'TopicThreadController@show');
        Route::apiResource('topics', 'TopicController');


        // Users
        Route::get('/users/{user}/profile', 'UserProfileController@show');
        Route::patch('/users/{user}/profile', 'UserProfileController@update');
        Route::apiResource('users', 'UserController');
    });
});
