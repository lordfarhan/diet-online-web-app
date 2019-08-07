<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    public $primaryKey = 'unique_id';

    public $timestamps = false;
}
