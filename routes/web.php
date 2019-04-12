<?php
use App\Transaction;
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

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin/product', 'DataController@GetAllData');

Route::get('/admin/paid','DataController@UpdatePaid');

Route::get('/admin/delivered','DataController@UpdateDelivered');
