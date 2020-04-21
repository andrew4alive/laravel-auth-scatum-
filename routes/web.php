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

Route::get('/webscrap/review', 'WebScrapController@review');
Route::post('/webscrap/review/approve', 'WebScrapController@approve_review');
Route::delete('/webscrap/review/{webscrap}', 'WebScrapController@destroy_review');
Route::delete('/webscrap/review', 'WebScrapController@delete_all_review');
Route::resource('/webscrap', 'WebScrapController');

//Route::post('/webscrapexe', 'WebScrapController@craw');

Auth::routes(["verify"=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
