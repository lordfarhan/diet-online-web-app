<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public $PrimaryKey = 'id';

    public $timestamps = true;
}
