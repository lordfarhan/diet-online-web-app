<?php
use App\Transaction;
use App\Http\Controllers\APIController;

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

Route::get('/admin/today-batch', 'DataController@GetTodayBatch');
Route::get('/admin/harian-all', 'DataController@GetAllDietHarian');
Route::get('/admin/harian-unpaid', 'DataController@GetUnpaidDietHarian');
Route::get('/admin/harian-paid', 'DataController@GetPaidDietHarian');
Route::get('/admin/harian-done', 'DataController@GetDoneDietHarian');

Route::get('/admin/paid', 'DataController@UpdatePaid');

Route::get('/admin/delivered', 'DataController@UpdateDelivered');
