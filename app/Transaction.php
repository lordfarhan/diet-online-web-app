<?php

namespace App;

//SELECT packages.name, packages.price, users.name, users.phone,users.address,transactions.invoice,transactions.proof_of_payment,transactions.times,transactions.status FROM transactions JOIN users ON transactions.user_id = users.unique_id JOIN packages ON transactions.product_id = packages.unique_id

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $PrimaryKey = 'id';

    public $timestamps = true;
}
