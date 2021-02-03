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



Route::get('/', function () {
    return redirect('/login');
});
// Route::get('/', 'MonitoringController');


// DASHBOARD
Route::get('/dashboard', 'DashboardController');

// TRENDING REPORT
Route::get('/trending/report', 'TrendingReportController@index');

// ALARM
Route::prefix('alarm')->group(function () {
    Route::get('/alarm-list', 'AlarmController@alarmList');
    Route::get('/alarm-setting', 'AlarmController@alarmSetting');
});

// API
Route::get('/api/logs', 'ApiController@logs');
Route::get('/api/connection-logs', 'ConnectionController@logs');

// SETTING
Route::prefix('settings')->group(function () {
    //== All Setting
    Route::get('/', 'SettingController@index');

    //== Device
    Route::get('/device', 'DeviceController@index');
    Route::get('/device/{id}', 'DeviceController@detail');

    //== Sensor
    Route::get('/sensor', 'SensorController@index');


    //== SOCKET
    Route::get('/socket', 'GlobalSettingController@socket');
    Route::post('/socket/{id?}', 'GlobalSettingController@updateSocket');


    //== DB
    Route::get('/database', 'GlobalSettingController@database');
    Route::post('/database/backup', 'BackupController@backup');
    Route::post('/database/{id?}', 'GlobalSettingController@updateDatabase');


    //== API
    Route::get('/api-config', 'ApiSettingController@apiConfig');
    Route::post('/api-config/{id?}', 'ApiSettingController@updateApi');

    //== Other
    Route::get('/other', 'GlobalSettingController@other');
    Route::post('/other/{id?}', 'GlobalSettingController@updateOther');

    //== Maintenance
    Route::get('/privilege', 'PrivilegeController@index');
    Route::get('/privilege/create', 'PrivilegeController@create');
    Route::get('/privilege/{id}/edit', 'PrivilegeController@edit');
    Route::post('/privilege/store', 'PrivilegeController@store')->name('privilege.store');
    Route::put('/privilege/{id}', 'PrivilegeController@update')->name('privilege.update');
    Route::delete('/privilege/{id}', 'PrivilegeController@destroy')->name('privilege.delete');    

    //== Maintenance
    Route::get('/maintenance', 'MaintenanceController@index');
    Route::get('/maintenance/create', 'MaintenanceController@create');
    Route::get('/maintenance/{id}/edit', 'MaintenanceController@edit');
    Route::post('/maintenance/store', 'MaintenanceController@store')->name('maintenance.store');
    Route::put('/maintenance/{id}', 'MaintenanceController@update')->name('maintenance.update');
    Route::delete('/maintenance/{id}', 'MaintenanceController@destroy')->name('maintenance.delete');

    //== Maintenance
    Route::get('/goiot', 'GoiotController@index');
    Route::get('/goiot/create', 'GoiotController@create');
    Route::get('/goiot/{id}/edit', 'GoiotController@edit');
    Route::post('/goiot', 'GoiotController@store')->name('goiot.store');
    Route::put('/goiot/{id}', 'GoiotController@update')->name('goiot.update');
    Route::delete('/goiot/{id}', 'GoiotController@destroy')->name('goiot.delete');
});

// Route::post('/api/sensors', 'SensorController@active');



Auth::routes();



// --USER RESOURCE
Route::resource('/users', 'UserController');

// --DEPARTEMENT RESOURCE
Route::resource('/departements', 'DepartementController');
