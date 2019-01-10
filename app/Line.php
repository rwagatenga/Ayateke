<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    protected $fillable = [
       'blancheId', 'name', 'code', 'line_type', 'line_price', 'public_price', 'user_id'
    ];

    protected $table = "line";
}
