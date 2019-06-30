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

Route::get('/admin', 'DashboardController@ViewAdmin');

Route::get('/admin/log-out','DashboardController@LogOut');

Route::get('/admin/add-transaction','DashboardController@AddTransaction');

Route::get('/kirim-tanggapan','HomeController@KirimTanggapan');

Route::get('/show-email',function(){
    return view('mails.tanggapan');
});

Route::get('/admin/cetak-all','DashboardController@PrintAll');

Route::get('/admin/cetak-today-batch','DashboardController@PrintLabelToday');

Route::get('/admin/cetak/{id}','DashboardController@PrintLabel');

Route::get('/admin/show-cetak-all','DashboardController@ShowCetak');

Route::get('/admin/pembayaran','DashboardController@ViewPembayaran');

Route::get('/admin/latest',function(){
    return view('layouts.latest');
});

Route::get('/admin/pembayaran/check','DashboardController@CheckTransaction');

Route::get('/admin/pembayaran/approve/{invoice}','DashboardController@ApproveTransaction');

Route::get('/admin/pembayaran/disapprove/{invoice}','DashboardController@DisapproveTransaction');

Route::get('/admin/filter', 'DashboardController@FilterTable');

Route::get('/admin/latest-table','DashboardController@LatestTable');

Route::get('/admin/action','DashboardController@EditAndDelete');

Route::get('/admin/edit/{id}','DashboardController@Update');

Route::get('/admin/delete/{id}','DashboardController@Delete');

Route::get('/admin/login',function(){
    return view('login');
});

Route::post('/admin/login/check','DashboardController@Login');

Route::get('/admin/search','DashboardController@Search')->name('search.action');

Route::get('/',function(){
    return view('home');
});

Route::get('/rekomendasi-paket',function(){
    return view('rekomendasi');
});

Route::get('/cari-rekomendasi','HomeController@RekomendasiPaket');