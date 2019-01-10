<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rolover extends Model
{
    //
    protected $fillable = [
       'cId', 'index','m3','amount','userId'
    ];

    protected $table = "rolovers";
}
