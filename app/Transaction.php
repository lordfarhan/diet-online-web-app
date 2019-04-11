<?php

namespace App;

//SELECT daily_packages.name, daily_packages.price, users.name, users.phone,users.address,transactions.invoice,transactions.proof_of_payment,transactions.times,transactions.status FROM transactions JOIN users ON transactions.user_id = users.unique_id JOIN daily_packages ON transactions.product_id = daily_packages.unique_id

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $PrimaryKey = 'id';

    public $timestamps = true;

    public static function getTransaction(){
        return DB::table('transactions')
        ->select('transactions.uid','daily_packages.product_name', 'daily_packages.price', 'users.name', 'users.phone','users.address','transactions.invoice','transactions.proof_of_payment','transactions.times','transactions.status')
        ->join('daily_packages','transactions.product_id','=','daily_packages.unique_id')
        ->join('users','transactions.user_id','=','users.unique_id')
        ->get();
    }
}
