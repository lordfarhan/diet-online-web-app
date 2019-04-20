<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function GetTodayBatch()
    {
        $datenow = date('Y-m-d');
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('date', '=', $datenow)
            ->get();

        return view('today_batch')->with('transactions', $transactions);
    }

    public function GetUnpaidDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','DP001')
            ->where('product_id','=','DP002')
            ->where('product_id','=','DP003')
            ->where('status','=',1)
            ->get();

        return view('harian_unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','DP001')
            ->where('product_id','=','DP002')
            ->where('product_id','=','DP003')
            ->where('status','=',2)
            ->get();

        return view('harian_paid')->with('transactions', $transactions);
     }

    public function GetDoneDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','DP001')
            ->where('product_id','=','DP002')
            ->where('product_id','=','DP003')
            ->where('status','=',3)
            ->get();

        return view('harian_done')->with('transactions', $transactions);
     }

    public function GetAllDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','DP001')
            ->where('product_id','=','DP002')
            ->where('product_id','=','DP003')
            ->get();

        return view('harian_all')->with('transactions', $transactions);
     }

    public function UpdateDone($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 3;
        $transaction->save();
     }

    public function Delete($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
     }
}
//Butuh menghapus transaksi
//Butuh ubah status dari paid jadi done
