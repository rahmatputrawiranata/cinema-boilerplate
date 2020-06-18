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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function() {
    Route::post('auth/login', 'AuthController@login');

    Route::group(['middleware' => 'custom.auth'], function() {
        Route::get('auth/logout', 'AuthController@logout');
        Route::group(['middleware' => 'custom.auth.admin'], function() {
            Route::group(['prefix' => 'branches'], function() {
                Route::get('/', 'BranchController@index');
                Route::post('/', 'BranchController@create');
                Route::put('/{id}', 'BranchController@update');
                Route::delete('/{id}', 'BranchController@destroy');
            });
            Route::group(['prefix' => 'studios'], function() {
                Route::get('/', 'StudioController@index');
                Route::post('/', 'StudioController@create');
                Route::put('/{id}', 'StudioController@update');
                Route::delete('/{id}', 'StudioController@destroy');
            });
            Route::group(['prefix' => 'movies'], function() {
                Route::get('/', 'MovieController@index');
                Route::post('/', 'MovieController@create');
                Route::put('/{id}', 'MovieController@update');
                Route::delete('/{id}', 'MovieController@destroy');
            });
            Route::group(['prefix' => 'schedules'], function() {
                Route::get('/', 'ScheduleController@index');
                Route::post('/', 'ScheduleController@create');
                Route::put('/{id}', 'ScheduleController@update');
                Route::delete('/{id}', 'ScheduleController@destroy');
            });
        });

        Route::get('view-schedule', 'ScheduleController@userFilter');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
