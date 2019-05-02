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
//Harian
Route::get('/admin/harian-all', 'DataController@GetAllDietHarian');
Route::get('/admin/harian-unpaid', 'DataController@GetUnpaidDietHarian');
Route::get('/admin/harian-paid', 'DataController@GetPaidDietHarian');
Route::get('/admin/harian-done', 'DataController@GetDoneDietHarian');
// Khusus
Route::get('/admin/khusus-all', 'DataController@GetAllDietKhusus');
Route::get('/admin/khusus-unpaid', 'DataController@GetUnpaidDietKhusus');
Route::get('/admin/khusus-paid', 'DataController@GetPaidDietKhusus');
Route::get('/admin/khusus-done', 'DataController@GetDoneDietKhusus');
//Penurunan
Route::get('/admin/penurunan-all', 'DataController@GetAllDietPenurunan');
Route::get('/admin/penurunan-unpaid', 'DataController@GetUnpaidDietPenurunan');
Route::get('/admin/penurunan-paid', 'DataController@GetPaidDietPenurunan');
Route::get('/admin/penurunan-done', 'DataController@GetDoneDietPenurunan');
//Single Lunch Box
Route::get('/admin/lunch-all', 'DataController@GetAllLunch');
Route::get('/admin/lunch-unpaid', 'DataController@GetUnpaidLunch');
Route::get('/admin/lunch-paid', 'DataController@GetPaidLunch');
Route::get('/admin/lunch-done', 'DataController@GetDoneLunch');


Route::get('/admin/paid', 'DataController@UpdatePaid');

Route::get('/admin/delivered', 'DataController@UpdateDelivered');
