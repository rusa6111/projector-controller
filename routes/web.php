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
})->name('home');

Route::get('play', 'MainController@player')->name('player');

//Route::get('play/clock', 'MainController@clock')->name('clock');
Route::get('play/enquiry', 'MainController@enquiry')->name('enquiry');

Route::get('control', 'MainController@control')->name('control');

Route::get('control/add', 'MainController@add')->name('add');

Route::post('control/add', 'MainController@add_post')->name('add_post');
Route::post('control/delete', 'MainController@delete')->name('delete');
Route::post('control/play', 'MainController@play')->name('play');

