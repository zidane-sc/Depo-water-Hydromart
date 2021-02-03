<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('product/all', 'ApiProduct@all');

// Route::post('trending', 'JsonController@trendingJson');
// Route::post('consumption', 'JsonController@consumptionJson');

Route::get('users', 'UsersApi@index');

// DEVICE
Route::get('device', 'DeviceController@all');
Route::get('device/active', 'DeviceController@active');
Route::get('device/{id}', 'DeviceController@edit');
Route::put('device/{id}', 'DeviceController@update');
Route::delete('device/{id}', 'DeviceController@delete');
Route::post('device', 'DeviceController@store');

// -- TAG
Route::post('tag', 'TagController@storeTag');
Route::put('tag/{id}', 'TagController@update');
Route::delete('tag/{id}', 'TagController@delete');

// -- SENSOR
Route::get('sensors', 'SensorController@active');
Route::put('sensor/{id}', 'SensorController@update');


// -- TRENDING
Route::post('trending', 'TrendingReportController@trend');



// -- ALARM
Route::post('alarm-setting', 'AlarmController@store');
Route::delete('alarm-setting/{id}', 'AlarmController@delete');
Route::put('alarm-setting/{id}', 'AlarmController@update');

// -- BACKUP
Route::get('database/reset', 'BackupController@reset');
Route::post('database/backup', 'BackupController@backup');


// -- RESET TOTALIZER
Route::get('totalizer/reset', 'SensorController@resetTotalizer');
Route::get('totalizer', 'SensorController@summaryTotalizer');
