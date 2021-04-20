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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TodayController@view');
Route::post('/todayRegister', 'TodayController@todayRegister');
Route::get('/tomonth', 'HouseController@view');
Route::get('/dataCheck', 'HouseController@dataCheck');
Route::post('/register', 'HouseController@register');
Route::get('/beforeMonth', 'BeforeMonthController@view');
Route::post('/getBeforeData', 'BeforeMonthController@getBeforeData');
Route::get('/info', 'InfoController@view');
Route::post('/infoRegister', 'InfoController@register');