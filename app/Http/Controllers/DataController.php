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

        return view('harian.unpaid')->with('transactions', $transactions);
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

        return view('harian.paid')->with('transactions', $transactions);
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

        return view('harian.done')->with('transactions', $transactions);
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

        return view('harian.all')->with('transactions', $transactions);
    }

    public function GetUnpaidDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SP001')
            ->where('product_id','=','SP002')
            ->where('product_id','=','SP003')
            ->where('status','=',1)
            ->get();

        return view('khusus.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SP001')
            ->where('product_id','=','SP002')
            ->where('product_id','=','SP003')
            ->where('status','=',2)
            ->get();

        return view('khusus.paid')->with('transactions', $transactions);
     }

    public function GetDoneDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SP001')
            ->where('product_id','=','SP002')
            ->where('product_id','=','SP003')
            ->where('status','=',3)
            ->get();

        return view('khusus.done')->with('transactions', $transactions);
     }

    public function GetAllDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SP001')
            ->where('product_id','=','SP002')
            ->where('product_id','=','SP003')
            ->get();

        return view('khusus.all')->with('transactions', $transactions);
    }

    public function GetUnpaidDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','WL001')
            ->where('status','=',1)
            ->get();

        return view('penurunan.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','WL001')
            ->where('status','=',2)
            ->get();

        return view('penurunan.paid')->with('transactions', $transactions);
     }

    public function GetDoneDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','WL001')
            ->where('status','=',3)
            ->get();

        return view('penurunan.done')->with('transactions', $transactions);
     }

    public function GetAllDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','WL001')
            ->get();

        return view('penurunan.all')->with('transactions', $transactions);
    }

    public function GetUnpaidLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SL001')
            ->where('product_id','=','SL002')
            ->where('status','=',1)
            ->get();

        return view('penurunan.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SL001')
            ->where('product_id','=','SL002')
            ->where('status','=',2)
            ->get();

        return view('penurunan.paid')->with('transactions', $transactions);
     }

    public function GetDoneLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SL001')
            ->where('product_id','=','SL002')
            ->where('status','=',3)
            ->get();

        return view('penurunan.done')->with('transactions', $transactions);
     }

    public function GetAllLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id','=','SL001')
            ->where('product_id','=','SL002')
            ->get();

        return view('penurunan.all')->with('transactions', $transactions);
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
