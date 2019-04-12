<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function GetAllData(){
        // $transactions = Transaction::all();
        // $id = 0;
        // $array = array();
        // foreach($transactions as $transaction){
        //     $productid = $transaction->product_id;
        //     $product = Product::where('unique_id','=',$productid)->first();
        //     $array[$id] = $product;
        //     $id++;
        // }
        // return view('transactions')->with('transactions',$transactions)->with('products',[$array]);

            $transactions = DB::table('transactions')
            ->select('transactions.uid','packages.product_name', 'packages.price', 'users.name', 'users.phone','users.address','transactions.invoice','transactions.proof_of_payment','transactions.times','transactions.status')
            ->join('packages','transactions.product_id','=','packages.unique_id')
            ->join('users','transactions.user_id','=','users.unique_id')
            ->get();

        return view('transactions')->with('transactions',$transactions);
    }

    public function UpdateDone($id, Request $request){

    }

    
}
//Butuh menghapus transaksi
//Butuh ubah status dari paid jadi done
