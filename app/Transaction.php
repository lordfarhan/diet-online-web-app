<?php

namespace App;

//SELECT packages.name, packages.price, users.name, users.phone,users.address,transactions.invoice,transactions.proof_of_payment,transactions.times,transactions.status FROM transactions JOIN users ON transactions.user_id = users.unique_id JOIN packages ON transactions.product_id = packages.unique_id

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $PrimaryKey = 'uid';

    public $timestamps = true;

    public function UpdatePaid($id, $data){
        DB::table('transactions')->where('invoice',"=",$id)->update($data);
    }
    
    public function UpdateDelivered($date, $time, $data){
        DB::table('transactions')
        ->where('date',"=",$date)
        ->where('times','',$time)
        ->update($data);
    }
}
