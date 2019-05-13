<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register'=>false, 'verify'=> false, 'reset'=> false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seatData', 'SeatController@getSeatData')->name('seatData');

Route::middleware('auth')->group(function() {
    Route::get('/currentVote', 'VoteController@currentVote')->name('currentVote');
    Route::get('/changeVote', 'VoteController@changeVote')->name('changeVote');
    Route::post('/storeCurrent', 'VoteController@storeCurrent')->name('storeCurrent');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::resource('users', 'UserController');
    Route::resource('multipliers', 'MultiplierController');
    Route::resource('parties', 'PartyController');
    Route::resource('seatmods', 'SeatmodController');
    Route::resource('seatbase', 'SeatbaseController');
    Route::resource('motions', 'MotionController');
    Route::resource('votes', 'VoteController');
});