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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//worker
Route::group(['prefix' => 'worker', 'middleware' => 'auth'], function() {
    Route::get('/show', 'WorkerController@index')->name('worker.show');
    Route::get('/show/json', 'WorkerController@getWorker')->name('worker.show.json');
    Route::get('/rooms', 'HomeController@room')->name('worker.rooms');
});
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function(){
    Route::get('/by_location/json', 'APIController@getCountWorkerByLocation');
    Route::get('/calibrate','APIController@calibrate')->name('pcm.calibrate');
    Route::post('/danger','RoomController@store')->name('pcm.danger');
    Route::post('/undanger','RoomController@unDanger')->name('pcm.undanger');
    Route::get('/danger/all','RoomController@showDangerRooms')->name('pcm.danger.all');
});
