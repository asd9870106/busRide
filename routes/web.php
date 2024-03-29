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


Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['prefix' => 'station'], function () {
    Route::get('/', 'App\Http\Controllers\StationBusController@detail');
    Route::get('/qrcode', 'App\Http\Controllers\StationBusController@main')->name('set_station_qrcode');
    Route::get('/stationqrcode', 'App\Http\Controllers\StationBusController@busQrcode')->name('set_bus_qrcode');
    Route::get('/getstationid', 'App\Http\Controllers\StationBusController@getStationId')->name('get_stationid');
    Route::get('/getbusroute', 'App\Http\Controllers\StationBusController@getBusRoute')->name('get_busroute');
    Route::post('/getstationqrcode', 'App\Http\Controllers\StationBusController@generate')->name('get_station_qrcode');
    Route::post('/getdriverqrcode', 'App\Http\Controllers\StationBusController@getBusQrcode')->name('get_driver_qrcode');
    Route::post('/', 'App\Http\Controllers\StationBusController@create')->name('bus_rifo_create');
});

Route::group(['prefix' => 'driver'], function () {
    Route::get('/', 'App\Http\Controllers\DriverShowController@main');
    Route::group(['prefix' => 'getDriverData'], function () {
        Route::get('/taipeiBusData', 'App\Http\Controllers\GetDriverDataController@getTaipeiBusData')->name('get_driver_taipei_data');
        Route::get('/taipeiBusStop', 'App\Http\Controllers\GetDriverDataController@getTaipeiBusStop')->name('get_driver_taipei_stop');
        Route::get('/newTaipeiBusData', 'App\Http\Controllers\GetDriverDataController@getNewTaipeiBusData')->name('get_driver_newtaipei_data');
        Route::get('/newTaipeiBusStop', 'App\Http\Controllers\GetDriverDataController@getNewTaipeiBusStop')->name('get_driver_newtaipei_stop');
        Route::get('/getDetail', 'App\Http\Controllers\DriverShowController@getStopDetail')->name('get_stop_data');
        Route::delete('/', 'App\Http\Controllers\DriverShowController@delete')->name('delete_stop_data');
    });
});

Route::group(['prefix' => 'search'], function () {
    Route::get('/nearby', 'App\Http\Controllers\SearchController@nearby')->name('search_nearby');
    Route::get('/destination', 'App\Http\Controllers\SearchController@destination')->name('search_destination');
    Route::get('/getplanroute', 'App\Http\Controllers\SearchController@getPlanRoute')->name('get_plan_route');
    Route::get('/getnearbystation', 'App\Http\Controllers\SearchController@getNearbyStation')->name('get_nearby_station');
    Route::get('/getdestinationstation', 'App\Http\Controllers\SearchController@getDestinationStation')->name('get_destination_station');
});

// 測試功能
Route::get('/example', 'App\Http\Controllers\StationBusController@example');
Route::get('/test/qrcode', 'App\Http\Controllers\QrcodeController@index');
Route::post('/qrcode', 'App\Http\Controllers\QrcodeController@generate')->name('qrcode.generate');

// 新增 資料庫Table
Route::group(['prefix' => 'create'], function () {
    Route::get('/', 'App\Http\Controllers\GetDataController@index');
    Route::post('/station', 'App\Http\Controllers\GetDataController@createStationQrcode')->name('create_station_qrcode');
    Route::post('/driver', 'App\Http\Controllers\GetDataController@createDriverQrcode')->name('create_driver_qrcode');
    Route::post('/table', 'App\Http\Controllers\GetDataController@create')->name('create_bus_station');
    Route::post('/createBusNumber', 'App\Http\Controllers\GetDataController@createBusNumber')->name('create_bus_number');
});

// 取得資料
Route::get('/getTaipeiStop', 'App\Http\Controllers\GetDataController@getTaipeiStop')->name('get_taipei_stop');
Route::get('/getNewTaipeiStop', 'App\Http\Controllers\GetDataController@getNewTaipeiStop')->name('get_newtaipei_stop');
Route::get('/getStationData', 'App\Http\Controllers\GetDataController@getStationData')->name('get_station_data');
Route::get('/getBusdata', 'App\Http\Controllers\GetDataController@getBusStation')->name('get_taipei_station');
Route::get('/getNewtaipeiStation', 'App\Http\Controllers\GetDataController@getNewTaipeiStation')->name('get_newtaipei_station');
Route::get('/getBusNumber', 'App\Http\Controllers\GetDataController@getBusNumber')->name('get_bus_number');

// Route::get('/', 'Auth\LoginController@destroy')->name('BackStage_logout');

