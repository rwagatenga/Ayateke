<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    //
    protected $fillable = [
       'sectorId', 'name',
    ];

    protected $table = "ad_cells";
}
