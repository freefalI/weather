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

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
    /*
     * Station Endpoints
     */
    Route::get('stations', 'StationController@index')->name('stations.index');
    Route::get('tasks', 'TaskController@index')->name('tasks.index');
});


Route::get('add_measure','Api\WeatherCharacteristicController@store');
