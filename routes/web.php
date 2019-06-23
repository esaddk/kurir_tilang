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
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/admins', 'AdminController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Order
Route::get('/CreateOrder', 'OrderController@CreateOrder')->name('CreateOrder');
Route::post('/SubmitOrder', 'OrderController@SubmitOrder')->name('SubmitOrder');
Route::get('/GetAllPendingOrder', 'OrderController@GetAllPendingOrder')->name('GetAllPendingOrder');
Route::get('/GetPendingOrder/{id}', 'OrderController@GetPendingOrder')->name('GetPendingOrder');
Route::post('/SubmitValidasi', 'OrderController@SubmitValidasi')->name('SubmitValidasi');


