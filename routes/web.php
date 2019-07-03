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

//Create Order
Route::get('/CreateOrder', 'OrderController@CreateOrder')->name('CreateOrder');
Route::post('/SubmitOrder', 'OrderController@SubmitOrder')->name('SubmitOrder');

//Validasi Data
Route::get('/GetAllPendingOrder', 'OrderController@GetAllPendingOrder')->name('GetAllPendingOrder');
Route::get('/GetPendingOrder/{id}', 'OrderController@GetPendingOrder')->name('GetPendingOrder');
Route::post('/SubmitValidasi', 'OrderController@SubmitValidasi')->name('SubmitValidasi');

//Validasi Transfer Ongkir
Route::get('/GetAllUnpaidOrder', 'OrderController@GetAllUnpaidOrder')->name('GetAllUnpaidOrder');
Route::get('/GetUnpaidOrder/{id}', 'OrderController@GetUnpaidOrder')->name('GetUnpaidOrder');
Route::post('/SubmitFotoTransfer', 'OrderController@SubmitFotoTransfer')->name('SubmitFotoTransfer');
Route::get('/ValidateTransferOrder/{id}', 'OrderController@ValidateTransferOrder')->name('ValidateTransferOrder');
Route::post('/SubmitValidTransfer', 'OrderController@SubmitValidTransfer')->name('SubmitValidTransfer');

// GetUnconfirmedTransfer
Route::get('/WaitPaymentConfirmation', 'OrderController@WaitPaymentConfirmation')->name('WaitPaymentConfirmation');

// Kurir Konfirmasi Order
Route::get('/KurirConfirmOrder/{id}', 'OrderController@KurirConfirmOrder')->name('KurirConfirmOrder');
Route::get('/KurirRejectOrder', 'OrderController@KurirRejectOrder')->name('KurirRejectOrder');

// Get Onprogress Order
Route::get('/GetAllOnprogressOrder', 'OrderController@GetAllOnprogressOrder')->name('GetAllOnprogressOrder');
Route::get('/GetOnprogressOrder/{id}', 'OrderController@GetOnprogressOrder')->name('GetOnprogressOrder');
Route::post('/UpdateStatusPengiriman', 'OrderController@UpdateStatusPengiriman')->name('UpdateStatusPengiriman');

// Get Complete Order
Route::get('/GetAllCompleteOrder', 'OrderController@GetAllCompleteOrder')->name('GetAllCompleteOrder');

