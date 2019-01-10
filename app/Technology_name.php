<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology_name extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    protected $table = "Technology_names";
}
