<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', 'MapController@index');


Route::get('/test', 'TestController@index');
/*
 * Stations Routes
 */
Route::get('/stations_list', 'MapController@index')->name('station_map.index');
Route::get('/tasks_map', 'TaskController@tasksMap')->name('tasks.map');
Route::resource('stations', 'StationController');
Route::resource('tasks', 'TaskController');

Route::get('stats', 'StatisticController@index')->name('stats');
Route::get('forecasts', 'ForecastController@index')->name('forecasts');


Route::any('{catchall}', function ($catchall) {
    // Log::info(time());
    Log::info($catchall);
    return 'test '.$catchall;
});

