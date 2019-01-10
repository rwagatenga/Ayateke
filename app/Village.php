<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    //
    protected $fillable = [
       'cellId', 'name',
    ];

    protected $table = "ad_villages";
}
