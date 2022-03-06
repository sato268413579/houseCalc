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

Route::get('/', 'TodayController@view')->name('today.index');
Route::post('/todayRegister', 'TodayController@todayRegister')->name('today.register');

Route::get('/tomonth', 'HouseController@view')->name('house.index');
Route::post('/dataCheck', 'HouseController@dataCheck');
Route::post('/register', 'HouseController@register')->name('house.register');
Route::post('/getAjaxData', 'HouseController@getAjaxData');

Route::get('/beforeMonth', 'BeforeMonthController@view');
Route::post('/getBeforeData', 'BeforeMonthController@getBeforeData');
Route::post('/dayDelete', 'BeforeMonthController@dayDelete');

Route::get('/info', 'InfoController@view')->name('info.index');
Route::post('/infoRegister', 'InfoController@register')->name('info.register');