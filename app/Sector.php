<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    protected $fillable = [
       'districtId', 'name',
    ];

    protected $table = "ad_sectors";
}
